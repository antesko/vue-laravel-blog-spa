<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index ()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id)
    {
        return User::with('posts')
            ->with('comments')
            ->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @param User                      $user
     * @return User
     * @internal param int $id
     */
    public function update (Request $request, User $user)
    {
        $this->validate($request, [
            'name'     => 'required|between:2,50',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'min:6|confirmed',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->avatar = $request->input('avatar') ?: null;

        $user->save();

        return $user;
    }

    public function posts ($id)
    {
        $user = User::findOrFail($id);

        return $user->posts()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }
}
