<?php

namespace WGT\Models\Profanity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use WGT\Models\Firm;
use WGT\Models\Profanity;
use WGT\Models\User;

class ProfanityIgnore extends Model
{
    protected $fillable = [
        'profanity_id',
        'user_ignored_id',
        'firm_ignored_id',
        'network_ignored_id',
        'user_id',
    ];

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
