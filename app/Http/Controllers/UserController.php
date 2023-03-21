<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        return User::find($user);
    }

    public function update(Request $request, User $user)
    {
        $user = User::find($user);
        $user->update($request->all());
        return $user;
    }

    public function destroy(Request $request, User $user)
    {
        $user = User::findOrFail($user);
        $user->delete();

        return 204;
    }
}
