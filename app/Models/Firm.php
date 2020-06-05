<?php

namespace WGT\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use WGT\Models\Firm\FirmAddress;
use WGT\Models\Firm\FirmExtra;

class Firm extends Model implements Transformable
{
    use SoftDeletes, TransformableTrait;

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

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_firm');
    }
}
