<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        return Post::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store (Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'title'   => 'required|min:3',
            'body'    => 'required|min:10'
        ]);

        return Post::create([
            'user_id'  => $request->input('user_id'),
            'title'    => $request->input('title'),
            'body'     => $request->input('body'),
            'image'    => $request->input('image') ?: null,
            'tags'     => $request->has('tags') ? json_encode($request->input('tags')) : null,
            'featured' => $request->input('featured') ?: false
        ]);
    }

    /**
     * Display the specified resource.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id)
    {
        return Post::with('user')
            ->with('comments')
            ->with('comments.user')
            ->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id)
    {
        //
    }

    public function comments ($id)
    {
        $post = Post::findOrFail($id);

        return $post->comments()->with('user')->get();
    }
}
