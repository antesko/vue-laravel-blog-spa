<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index ()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {
        //
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
     * Show the form for editing the specified resource.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit ($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name'  => 'required|between:2,50',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'min:6|confirmed',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        if($request->has('avatar')) {
            $user->avatar = $request->input('avatar');
        }

        $user->save();

        return $user;
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

    public function posts ($id)
    {
        $user = User::findOrFail($id);

        return $user->posts()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }
}
