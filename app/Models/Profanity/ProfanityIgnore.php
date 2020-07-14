<?php

namespace WGT\Models\Profanity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

use WGT\Models\Firm;
use WGT\Models\Profanity;
use WGT\Models\User;

class ProfanityIgnore extends Model
{
    use SoftDeletes, LogsActivity;

    protected $fillable = [
        'profanity_id',
        'user_ignored_id',
        'firm_ignored_id',
        'network_ignored_id',
        'user_id',
    ];

    /**
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

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
     * @return BelongsTo
     */
    public function profanity(): BelongsTo
    {
        return $this->belongsTo(Profanity::class);
    }

    /**
     * @return BelongsTo
     */
    public function userIgnored(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function firmIgnored(): BelongsTo
    {
        return $this->belongsTo(Firm::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
