<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService implements IUserService
{

    public function create(Request $request): User
    {
        return User::create([
            'name' => $request->name,
            'age' => $request->age,
            'department' => $request->department,
        ]);

    }
}
