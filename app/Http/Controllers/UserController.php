<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UpdateUsersRequest;
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

    public function update(UpdateUsersRequest $request, User $user)
    {
        $user->update($request->validated());
        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return 204;
    }
}
