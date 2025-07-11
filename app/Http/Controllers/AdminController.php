<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        $admins = User::where('role', "=", "admin")->paginate(10);
        return view('admin.index', ['admins' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        return view('admin.Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string'],
            'confirm_password' => ['required_with:password', 'same:password'],
            'role' => ['required']
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->back()->with('success', 'User and Admin created successfully');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        $user = User::findOrFail($id);
        return view('admin.show', ['admin' => $user]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        $user = User::findOrFail($id);
        // dd($user);
        return view('admin.Edite', ['admin' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email'],
            'role' => ['required']
        ]);
        $user = User::findOrFail($id);
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);
        return redirect()->route('admins.index')->with('success', 'Student and user updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admins.index')->with('success', 'Admin and user Deleted successfully.');

    }
}
