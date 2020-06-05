<?php

namespace WGT\GraphQL\Mutations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

use WGT\Models\Profanity;

class ProfanityMutator
{
    /**
     * @param null $root
     * @param array $args
     * @return Model
     */
    public function create($root, array $args): Model
    {
        $request = Arr::only($args, ['word']);
        $userId = auth()->user()->id;

        $profanity = new Profanity($request);
        $profanity->user_id = $userId;
        $profanity->save();

        return $profanity;
    }

    /**
     * @param null $root
     * @param array $args
     * @return Model
     */
    public function update($root, array $args): Model
    {
        $request = Arr::only($args, ['id', 'word']);
        $userId = auth()->user()->id;

        $profanity = Profanity::find($request['id']);
        $profanity->user_id = $userId;
        $profanity->word = $request['word'];
        $profanity->save();
        return $profanity;
    }
}
