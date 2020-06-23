<?php

namespace WGT\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'firm_id',
        'name',
        'description',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
    ];

}
