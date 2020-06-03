<?php

namespace WGT\Models\Profanity;

use Illuminate\Database\Eloquent\Model;

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
}
