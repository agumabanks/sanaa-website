<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        $data['is_admin'] = (bool) ($data['is_admin'] ?? false);

        User::create($data);

        return redirect()->route('dashboard.users')->with('status', 'User created');
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8'],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        $update = [
            'name' => $data['name'],
            'email' => $data['email'],
            'is_admin' => (bool) ($data['is_admin'] ?? false),
        ];

        if (!empty($data['password'])) {
            $update['password'] = $data['password'];
        }

        $user->update($update);

        return redirect()->route('dashboard.users')->with('status', 'User updated');
    }

    public function destroy(User $user)
    {
        // Prevent deleting own account via UI
        if (auth()->id() === $user->id) {
            return redirect()->route('dashboard.users')->with('status', 'You cannot delete your own account');
        }

        $user->delete();
        return redirect()->route('dashboard.users')->with('status', 'User deleted');
    }
}

