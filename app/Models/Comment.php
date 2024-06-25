<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

     #----- Relations -----#
     public function replies()
     {
         return $this->hasMany(Comment::class, 'parent_id');
     }
     public function likes()
     {
         return $this->hasMany(Like::class);
     }
     public function user()
     {
        return $this->belongsTo(User::class);
     }
     public function parent()
     {
         return $this->belongsTo(Comment::class, 'parent_id');
     }
}
