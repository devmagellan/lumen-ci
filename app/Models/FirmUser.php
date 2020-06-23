<?php

namespace WGT\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FirmUser extends Pivot
{
    /**
     * @var bool
     */
    public $incrementing = true;

    /**
     * @return BelongsTo
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

}
