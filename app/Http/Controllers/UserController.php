<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $abc = 1234;

        return view('users.index', compact('abc'));
    }
}
