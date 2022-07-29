<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\IUserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private IUserService $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $response = User::all();

        return response()->json( data: $response, status: 200,);

    }


    public function store(Request $request)
    {
         //validate request
        //NOTE: here I validate the request.

        //create the user
        $response = $this->userService->create($request);

        return response()->json( data: $response, status: 201,);

    }

    public function show(User $user)
    {
        return response()->json( data: $user, status: 200,);

    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json( data: '', status: 204,);
    }

    public function update(Request $request, int $user )
    {
        $user = User::find($user);
        $user->update($request->all());
        return response()->json( data: $user, status: 200,);

    }


}
