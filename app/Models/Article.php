<?php

namespace App\Models;

use App\Http\Services\LoggingService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    protected static function booted()
    {
        static::updated(function ($article) {
            (new LoggingService($article))->createLog();
        });
    }
}
