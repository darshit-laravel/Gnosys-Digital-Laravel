<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use PHPUnit\Metadata\Uses;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['wallet:id,user_id,balance'])->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|digits_between:10,12|unique:users',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone ?? null,
            'password' => Hash::make($request->password),
            'is_active' => $request->is_active == 1 ? 1 : 0,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => [
                'nullable',
                'digits_between:10,12',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone ?? null;
        $user->is_active = $request->is_active == 1 ? 1 : 0;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->update();

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    public function getTransectionHistoty(Request $request)
    {
        $id = $request->id ? decrypt($request->id) : '';

        if ($id) {

            $historys = User::with([
                'wallet.histories' => function ($query) use ($id) {
                    $query->where('user_id', $id)
                        ->latest();
                }
            ])->find($id);

            $html = view(
                'admin.users.wallet-history',
                compact('historys')
            )->render();

            return response()->json([
                'status' => true,
                'html'   => $html
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Invalid User'
        ]);
    }
}
