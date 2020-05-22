<?php

namespace WGT;

use Illuminate\Database\Eloquent\Model;

class UserEducationBackground extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'school',
        'dates_attended',
        'field_of_study',
        'grade',
        'activities_societies',
        'description',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'school' => 'string',
        'dates_attended' => 'string',
        'field_of_study' => 'string',
        'grade' => 'string',
        'activities_societies' => 'string',
        'description' => 'string',
    ];

}
