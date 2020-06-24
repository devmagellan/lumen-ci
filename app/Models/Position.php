<?php

namespace WGT\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasPermissions;

class Position extends Model
{
    use HasPermissions, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'firm_id',
        'name',
        'description',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(Position::class)->using(UserPosition::class);
    }
}
