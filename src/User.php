<?php

namespace WGT;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use WGT\UserEducationBackground;
use WGT\UserProfessionalExperience;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, JWTSubject
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
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
    ];

    /**
     * @return HasOne
     */
    public function educationBackground(): HasOne
    {
        return $this->hasOne(UserEducationBackground::class);
    }

    /**
     * @return HasOne
     */
    public function professionalExperience(): HasOne
    {
        return $this->hasOne(UserProfessionalExperience::class);
    }

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
