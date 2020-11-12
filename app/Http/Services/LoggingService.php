<?php

namespace App\Http\Services;

use App\Models\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LoggingService
{
    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function createLog()
    {

        if ($this->model->wasChanged()) {

            $changes = [];

            foreach ($this->model->getChanges() as $field => $new_value) {

                $changes[$field] = [
                    'from' => is_object($this->model->getOriginal($field)) ? $this->model->getOriginal($field)->format('Y-m-d H:i') : $this->model->getOriginal($field),
                    'to' => $new_value
                ];
            }

            $new_log = new Log();

            $new_log->user_id = Auth::user()->id;
            $new_log->model = get_class($this->model);
            $new_log->changes = json_encode($changes);
            $new_log->ip_address = request()->ip();
            $new_log->agent =  request()->header('User-Agent');

            $new_log->save();
        }
    }


}
