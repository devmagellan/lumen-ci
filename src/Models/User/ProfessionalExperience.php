<?php

namespace WGT\Models\User;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProfessionalExperience extends Model implements Transformable
{
    use TransformableTrait;

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
