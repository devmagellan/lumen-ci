<?php

namespace WGT\Models\Profanity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;

use WGT\Models\Firm;
use WGT\Models\Profanity;
use WGT\Models\User;

class ProfanityIgnore extends Model implements Presentable
{
    use PresentableTrait;

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

    public function userIgnored()
    {
        return $this->belongsTo(User::class);
    }

    public function firmIgnored()
    {
        return $this->belongsTo(Firm::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
