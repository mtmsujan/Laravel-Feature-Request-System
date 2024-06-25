<?php

declare (strict_types = 1);

namespace App\Services;

use App\Enums\FeatureStatusEnum;
use App\Http\Requests\FeatureRequest;
use App\Models\Feature;
use App\Models\Vote;

class FeatureService
{
    /**
     * Creates a new feature request
     *
     * @param FeatureRequest $request
     * @return Feature
     */
    public static function store(FeatureRequest $request): Feature
    {
        $email = $request->cookie('feature_requester_email');
        return Feature::create([
             ...$request->safe([ 'title', 'body', 'priority' ]),
            'email'   => $email,
            'user_id' => auth()->id(),
         ]);
    }

    public static function vote(Feature $feature, $count = 1)
    {
        if (auth()->user()->is_admin) {
            Vote::create([
                'feature_id' => $feature->id,
                'email'      => userEmail(),
                'count'      => random_int(10, 20),
             ]);
            return true;
        }
        if ($feature->status != FeatureStatusEnum::COMPLETED->value) {
            $hasBoth = Vote::where([ 'email' => userEmail(), 'feature_id' => $feature->id ])->count() == 2;
            if ($hasBoth) {
                Vote::where([ 'email' => userEmail(), 'feature_id' => $feature->id ])->delete();
            }
            $vote = Vote::where([ 'email' => userEmail(), 'feature_id' => $feature->id, 'count' => $count ])->first();
            if ($vote) {
                $vote->delete();
            }
            Vote::create([
                'feature_id' => $feature->id,
                'email'      => userEmail(),
                'count'      => $count,
             ]);
        }else{
            notify()->warning('Voting on this feature is not allowed', 'Request Already Completed!');
        }
    }
}
