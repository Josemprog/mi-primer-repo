<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = User::get();

        return view('admin')->with('accounts', $accounts);
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('edit', [
            'user' => $user
        ]);
    }

    public function change(User $user)
    {
        return $user;
    }
}
