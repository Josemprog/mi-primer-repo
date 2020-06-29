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

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->update([
            'name' => $request->name,
        ]);

        if ($request->select == 1) {
            $user->update([
                'isEnabled' => true,
            ]);
        } else {
            $user->update([
                'isEnabled' => false,
            ]);
        }

        return redirect()->route('admin', $user);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('admin', $user);
    }
}
