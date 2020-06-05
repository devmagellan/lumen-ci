<?php

namespace WGT\Models\Profanity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use WGT\Models\Firm;
use WGT\Models\User;

class ProfanityLog extends Model
{
    protected $fillable = [
        'user_id',
        'firm_id',
        'original_content',
        'updated_content',
        'replaced_words',
        'class_name',
        'method',
        'table_name',
        'table_field',
        'table_id'
    ];

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function firm(): BelongsTo
    {
        return $this->belongsTo(Firm::class);
    }
}
