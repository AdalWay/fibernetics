<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

interface IUserService
{
    public function create(Request $request): User;

}
