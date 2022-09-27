<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create', Auth::user());

        $usrId = Auth::id();
        return view('users.create',['userId' => $usrId]);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Auth::user());

        $request->validate([
            User::EMAIL => 'required',
            User::PASSWORD => 'required',
            User::MANAGER => 'required',
            User::USER_ROLE => 'required'
        ]);

        $data = $request->input();
        $password = $data['password'];
        $hashed =  Hash::make($password);

        User::create([
            User::EMAIL => $data['email'],
            User::PASSWORD => $hashed,
            User::MANAGER => $data['manager'],
            User::USER_ROLE => $data['role']
        ]);

        return redirect()->route('home')->with('success','User created successfully.');
    }

}
