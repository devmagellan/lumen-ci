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
        'user_id',
    ];

    public function profanity(): BelongsTo
    {
        return $this->belongsTo(Profanity::class);
    }

    public function userIgnored(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function firmIgnored(): BelongsTo
    {
        return $this->belongsTo(Firm::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
