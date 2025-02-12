<?php

namespace App\Models;

use App\Http\Services\LoggingService;
use App\Listeners\UserSaved;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'terms_agreement',
        'terms_agreement_ip',
        'terms_agreement_agent',
        'terms_agreement_date',
        'subscribe',
        'subscribe_ip',
        'subscribe_agent',
        'subscribe_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['profile_image_path'];

    public function getProfileImagePathAttribute()
    {
        return $this->profile_image ? 'storage/profile_images/' . $this->profile_image : null;
    }

    public function logs()
    {
        return $this->hasMany('App\Models\Log');
    }

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    protected static function booted()
    {
        static::updated(function ($user) {
            (new LoggingService($user))->createLog();
        });
    }
}
