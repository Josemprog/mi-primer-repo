<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveUsers;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): \Illuminate\View\View
    {
        $users = $request;

        $users = User::orderBy('id', 'ASC')
            ->name($users->name)
            ->email($users->email)
            ->enabled($users->enabled)
            ->paginate(6);

        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param SaveUsers $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveUsers $request): \Illuminate\Http\RedirectResponse
    {
        $user = new User($request->validated());
        $user->email_verified_at = now();
        $user->save();
        return redirect()->route('users.index')->with('message', 'User Created');
    }

    /**
     * Display the specified user.
     *
     * @param [type] $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user): \Illuminate\View\View
    {
        return view('admin.users.edit')->with('user', $user);
    }

    /**
     * Update the specified user in storage.
     *
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user, SaveUsers $request)
    {

        $user->update($request->validated());

        return redirect()->route('users.index', $user)->with('message', 'Edited User');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user): \Illuminate\Http\RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index', $user)->with('message', 'User Removed');
    }
}
