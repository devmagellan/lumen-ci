<?php

namespace WGT\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

use WGT\Models\Country;
use WGT\Models\User;

/**
 * Class Currency.
 *
 * @package namespace WGT\Models;
 */
class Currency extends Model
{
    use SoftDeletes, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'alpha_3_code',
        'country_id',
        'user_id'
    ];

    /**
     * @return array
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * all changed fields are adding to the log
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
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
