<?php

namespace WGT\Models\Firm;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Address extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * @var array
     */
    protected $fillable = [
        'firm_id',
        'name',
        'address',
        'fax',
        'phone',
        'postal_code',
        'alt_phone',
        'city',
        'state',
        'country',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'firm_id' => 'integer',
        'name' => 'string',
        'address' => 'string',
        'fax' => 'string',
        'phone' => 'string',
        'postal_code' => 'string',
        'alt_phone' => 'string',
        'city' => 'string',
        'state' => 'string',
        'country' => 'char',
    ];
}
