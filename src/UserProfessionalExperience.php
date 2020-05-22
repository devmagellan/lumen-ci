<?php

namespace WGT;

use Illuminate\Database\Eloquent\Model;

class UserProfessionalExperience extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'current_company',
        'job_title',
        'time_period',
        'description',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'current_company' => 'string',
        'job_title' => 'string',
        'time_period' => 'string',
        'description' => 'string',
    ];
}
