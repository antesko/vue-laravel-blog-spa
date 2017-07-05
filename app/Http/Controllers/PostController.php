<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Database\Eloquent\Collection;
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
        $this->validate($request, array_merge($this->validationRules(), [
            'user_id' => 'required|exists:users,id'
        ]));

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
     * @param Post                      $post
     * @return Post
     * @internal param int $id
     */
    public function update (Request $request, Post $post)
    {
        $this->validate($request, $this->validationRules());

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->image = $request->input('image') ?: null;
        $post->tags = $request->has('tags') ? json_encode($request->input('tags')) : null;
        $post->featured = $request->input('featured') ?: false;

        $post->save();

        return $post;
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

    /**
     * @param $id
     * @return Collection
     */
    public function comments ($id)
    {
        $post = Post::findOrFail($id);

        return $post->comments()->with('user')->get();
    }

    /**
     * @return array
     */
    private function validationRules ()
    {
        return [
            'title' => 'required|min:3',
            'body'  => 'required|min:10'
        ];
    }
}
