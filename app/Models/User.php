<?php

namespace WGT\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Auth\Authorizable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use WGT\Models\Firm;
use WGT\Notifications\ResetPassword;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, JWTSubject
{
    use Authenticatable, Authorizable, CanResetPassword, HasRoles, MustVerifyEmail, Notifiable, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'birthdate',
        'email',
        'business_email',
        'phone',
        'mobile',
        'business_phone',
        'business_phone_extension',
        'business_mobile',
        'toll_free_business_number',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'password',
        'secret_phrase',
        'fingerprint_code',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'secret_phrase', 'fingerprint_code',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'first_name' => 'string',
        'middle_name' => 'string',
        'last_name' => 'string',
        'gender' => 'string',
        'birthdate' => 'date:Y-m-d',
        'email' => 'string',
        'business_email' => 'string',
        'phone' => 'string',
        'mobile' => 'string',
        'business_phone' => 'string',
        'business_phone_extension' => 'string',
        'business_mobile' => 'string',
        'toll_free_business_number' => 'string',
        'address' => 'string',
        'city' => 'string',
        'state' => 'string',
        'country' => 'string',
        'zip_code' => 'string',
        'secret_phrase' => 'string',
        'fingerprint_code' => 'string',
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

    /**
     * @param string
     * @return void
     */
    public function setPasswordAttribute($password): void
    {
        if (Hash::needsRehash($password)) {
            $password = Hash::make($password);
        }

        $this->attributes['password'] = $password;
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }

    /**
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * @return BelongsToMany
     */
    public function employments(): BelongsToMany
    {
        return $this->belongsToMany(Firm::class);
    }

    /**
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * @return BelongsToMany
     */
    public function positions(): BelongsToMany
    {
        $relation = $this->belongsToMany(Position::class, 'user_position');
        if (!empty($this->pivot->firm_id)) {
            $relation->where('firm_id', $this->pivot->firm_id);
        }

        return $relation;
    }

    /**
     * @return Collection
     */
    public function getPermissionsViaPositions(): Collection
    {
        return $this->loadMissing('positions', 'positions.permissions')
            ->positions->flatMap(function ($position) {
                return $position->permissions;
            })->sort()->values();
    }

    /**
     * @return Collection
     */
    public function getAllPermissions(): Collection
    {
        $permissions = $this->permissions;

        if ($this->roles) {
            $permissions = $permissions->merge($this->getPermissionsViaRoles());
        }

        if ($this->positions) {
            $permissions = $permissions->merge($this->getPermissionsViaPositions());
        }

        return $permissions->sort()->values();
    }
}
