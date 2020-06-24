<?php

namespace WGT\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserPosition extends Pivot
{
    /**
     * @var bool
     */
    public $incrementing = true;

}
