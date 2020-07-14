<?php

namespace WGT\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use WGT\Models\Currency;

class Product extends Model
{
    use SoftDeletes, LogsActivity;

    /**
     * @var array
     */
    protected $fillable = [
        'currency_id',
        'name',
        'description',
        'type',
        'price',
        'association_discount',
        'retail_price',
        'report_price',
        'cost',
        'visible',
        'status',
        'active',
        'vendor_sku',
        'anonymous',
        'matching',
        'association_product',
        'matching_sku',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'currency_id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'type' => 'string',
        'price' => 'decimal:2',
        'association_discount' => 'decimal:2',
        'retail_price' => 'decimal:2',
        'report_price' => 'decimal:2',
        'cost' => 'decimal:2',
        'visible' => 'string',
        'status' => 'string',
        'active' => 'boolean',
        'vendor_sku' => 'string',
        'anonymous' => 'boolean',
        'matching' => 'integer',
        'association_product' => 'string',
        'matching_sku' => 'string',
    ];

    /**
     * @var bool
     */
    protected static $logFillable = true;

    /**
     * @var bool
     */
    protected static $logOnlyDirty = true;

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
    public function firms(): BelongsToMany
    {
        return $this->belongsToMany(Firm::class, 'product_firm');
    }
}
