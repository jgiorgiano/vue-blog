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

    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    protected static function booted()
    {
        static::updated(function ($article) {
            (new LoggingService($article))->createLog();
        });
    }
}
