<?php

namespace WGT;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use WGT\FirmAddress;
use WGT\FirmExtra;

class Firm extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'website',
        'discount',
        'type',
        'supplier',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'website' => 'string',
        'discount' => 'decimal:2',
        'type' => 'string',
        'supplier' => 'string',
        'status' => 'string',
    ];

    /**
     * @return HasOne
     */
    public function address(): HasOne
    {
        return $this->hasOne(FirmAddress::class);
    }

    /**
     * @return HasOne
     */
    public function extra(): HasOne
    {
        return $this->hasOne(FirmExtra::class);
    }
}
