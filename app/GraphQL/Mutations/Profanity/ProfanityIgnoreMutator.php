<?php

namespace WGT\GraphQL\Mutations\Profanity;

use Illuminate\Support\Arr;

use WGT\Models\Profanity\ProfanityIgnore;

class ProfanityIgnoreMutator
{
    public function create($root, array $args)
    {
        $request = Arr::only(
            $args, ['profanity_id', 'user_ignored_id', 'firm_ignored_id']
        );

        $profanityIgnore = new ProfanityIgnore($request);
        $profanityIgnore->user_id = auth()->user()->id;
        $profanityIgnore->save();

        return $profanityIgnore;
    }

    public function update($root, array $args)
    {
        $request = Arr::only(
            $args,
            ['id', 'profanity_id', 'user_ignored_id', 'firm_ignored_id']
        );

        $request['user_id'] = auth()->user()->id;

        $profanityIgnore = ProfanityIgnore::find($request['id']);
        $profanityIgnore->update($request);

        return $profanityIgnore;
    }
}
