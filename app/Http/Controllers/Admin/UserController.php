<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|string|min:6|confirmed',
            'role'           => 'required|in:student,admin',
            'full_name'      => 'required|string|max:255',
            'phone'          => 'nullable|string|max:20',
            'school_origin'  => 'nullable|string|max:255',
            'current_school' => 'nullable|string|max:255',
            'nisn'           => 'nullable|string|max:20',
            'address'        => 'nullable|string',
            'pob'            => 'nullable|string|max:255',
            'dob'            => 'nullable|date',
            'is_active'      => 'nullable|boolean',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = $request->boolean('is_active');

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        $user->loadCount('testSessions');
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password'       => 'nullable|string|min:6|confirmed',
            'role'           => 'required|in:student,admin',
            'full_name'      => 'required|string|max:255',
            'phone'          => 'nullable|string|max:20',
            'school_origin'  => 'nullable|string|max:255',
            'current_school' => 'nullable|string|max:255',
            'nisn'           => 'nullable|string|max:20',
            'address'        => 'nullable|string',
            'pob'            => 'nullable|string|max:255',
            'dob'            => 'nullable|date',
            'is_active'      => 'nullable|boolean',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['is_active'] = $request->boolean('is_active');

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
