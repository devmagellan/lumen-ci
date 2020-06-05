<?php

namespace WGT\Transformers;

use League\Fractal\TransformerAbstract;

class ProfanityIgnoreTransformer extends TransformerAbstract
{
    public function transform(\WGT\Models\Profanity\ProfanityIgnore $profanityIgnore)
    {
        return [
            'id' => (int) $profanityIgnore->id,
        ];
    }
}
