<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        Comment::create([
            ...$request->only('parent_id','body','feature_id'),
            'user_id'=> auth()->id()
        ]);
        return back();
    }
}
