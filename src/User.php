<?php

namespace WGT;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, JWTSubject
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
        'firm_id',
        'email',
        'password',
        'key',
        'first_name',
        'last_name',
        'phone_number',
        'extension',
        'mobile_number',
        'summary',
        'status',
        'profile_image',
        'activation_code',
        'activation_timestamp',
        'invited',
        'locale',
        'timezone',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'firm_id' => 'integer',
        'email' => 'string',
        'password' => 'string',
        'key' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'phone_number' => 'string',
        'extension' => 'string',
        'mobile_number' => 'string',
        'summary' => 'string',
        'status' => 'string',
        'profile_image' => 'integer',
        'activation_code' => 'string',
        'activation_timestamp' => 'datetime',
        'invited' => 'boolean',
        'locale' => 'string',
        'timezone' => 'string',
    ];

    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
