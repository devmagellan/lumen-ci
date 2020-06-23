<?php

namespace WGT\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use WGT\Models\Firm\FirmAddress;
use WGT\Models\Firm\FirmExtra;

class Firm extends Model
{
    use SoftDeletes, LogsActivity;

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
     * All changed fields are adding to the log
     *
     * @var bool
     */
    protected static $logFillable = true;

    /**
     * Only fields changed after the update
     *
     * @var bool
     */
    protected static $logOnlyDirty = true;

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
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->as('work')->withPivot(['id', 'position']);
    }
}
