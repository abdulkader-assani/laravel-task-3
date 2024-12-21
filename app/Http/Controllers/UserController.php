<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, User $user)
    {
        if ($request->user()->cannot('view', $user)) {
            abort(403);
        }

        $users = User::all();
        return view("users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, User $user)
    {
        if ($request->user()->cannot('create', $user)) {
            abort(403);
        }

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        if ($request->user()->cannot('create', $user)) {
            abort(403);
        }

        $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:App\Models\User",
            "password" => "required",
            "is_admin" => "boolean"
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "is_admin" => $request->is_admin,
        ]);

        return redirect()->route('users.index')->with('status', 'User Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
        if ($request->user()->cannot('viewAny', $user)) {
            abort(403);
        }

        return view("users.show", compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, User $user)
    {
        if ($request->user()->cannot('update', $user)) {
            abort(403);
        }
        
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if ($request->user()->cannot('update', $user)) {
            abort(403);
        }

        $request->validate([
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required",
            "is_admin" => "boolean"
        ]);

        $user->update([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "is_admin" => $request->is_admin,
        ]);

        return redirect()->route('users.index')->with('status', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        if ($request->user()->cannot('delete', $user)) {
            abort(403);
        }

        $user->delete();
        return redirect('/users')->with('status', 'User Deleted Successfully');
    }
}
