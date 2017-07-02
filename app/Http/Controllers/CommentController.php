<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store (Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|integer',
            'post_id' => 'required|integer',
            'body'    => 'required|min:3',
        ]);

        return Comment::create([
            'user_id' => $request->input('user_id'),
            'post_id' => $request->input('post_id'),
            'body'    => $request->input('body')
        ]);
    }
}
