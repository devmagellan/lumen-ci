<?php

namespace WGT;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class FirmExtra extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * @var array
     */
    protected $fillable = [
        'firm_id',
        'locale',
        'timezone',
        'currency',
        'contact_name',
        'email',
        'logo',
        'header_logo',
        'mobile_header_logo',
        'headline',
        'discount_fee',
        'as_discount_fee',
        'default_association',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'firm_id' => 'integer',
        'locale' => 'string',
        'timezone' => 'string',
        'currency' => 'char',
        'contact_name' => 'string',
        'email' => 'string',
        'logo' => 'integer',
        'header_logo' => 'integer',
        'mobile_header_logo' => 'integer',
        'headline' => 'string',
        'discount_fee' => 'decimal:2',
        'as_discount_fee' => 'decimal:2',
        'default_association' => 'integer',
    ];
}
