<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $guarded = [];

    #----- Relations -----#
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class)->where('parent_id', null);
    }

    public function scopeWithVotesCount($query)
    {
        $commentsRating = Vote::selectRaw('sum(count)')
            ->whereColumn('feature_id', 'features.id')
            ->getQuery();

        $base = $query->getQuery();
        if (is_null($base->columns)) {
            $query->select([$base->from.'.*']);
        }

        return $query->selectSub($commentsRating, 'votes_count');
    }
}
