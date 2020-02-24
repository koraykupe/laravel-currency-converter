<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display listing of users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => $request->is_admin,
            ]);
        } catch (QueryException $exception){
            return redirect()->back()->withErrors('Email is already registered.');
        }
        return redirect()->back()->with('success', 'User has been added successfully.');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        Log::info('User ' . $id . ' deleted');
        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
