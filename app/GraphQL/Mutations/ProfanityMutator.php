<?php

namespace WGT\GraphQL\Mutations;

use Illuminate\Support\Arr;

use WGT\Models\Profanity;

class ProfanityMutator
{
    public function create($root, array $args)
    {
        $request = Arr::only($args, ['word']);
        $userId = auth()->user()->id;

        $profanity = new Profanity($request);
        $profanity->user_id = $userId;
        $profanity->save();

        return $profanity;
    }

    public function update($root, array $args)
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
