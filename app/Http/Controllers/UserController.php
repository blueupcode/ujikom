<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    static private $validationCreateSchema = [
        'nama' => ['required', 'min:3', 'max:100'],
        'username' => ['required', 'min:3', 'max:30'],
        'password' => ['required', 'min:8'],
        'role' => ['required', 'in:admin,kasir,owner']
    ];

    static private $validationUpdateSchema = [
        'nama' => ['required', 'min:3', 'max:100'],
        'username' => ['required', 'min:3', 'max:30'],
        'password' => ['nullable', 'min:8'],
    ];

    static private $validationLoginSchema = [
        'username' => ['required', 'min:3', 'max:30'],
        'password' => ['required', 'min:8'],
    ];


    public function viewLogin()
    {
        return view('auth.login');
    }

    public function handleLogin(Request $request)
    {
        $data = $request->validate(self::$validationLoginSchema);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            Log::info('User login: ' . Auth::user()->id);

            return redirect()->route('report');
        } else {
            Log::warning('Failed to login: ' . json_encode($data));

            return back()->withErrors([
                'credential' => 'Login gagal cek kembali username dan password',
            ]);
        }
    }

    public function handleLogout()
    {
        Log::info('User logout: ' . Auth::user()->id);

        Auth::logout();

        return redirect()->route('login');
    }

    public function handleCreate(Request $request)
    {
        $data = $request->validate(self::$validationCreateSchema);

        if (Helpers::checkUserNameIsExist($data['username'])) {
            Log::warning('Username is exists: ' . $data['username']);

            return back()->withErrors([
                'username' => 'Username sudah ada'
            ]);
        } else {
            $data['password'] = Hash::make($data['password']);

            $user = Auth::user()->outlet->user()->create($data);

            Log::info('Create user: ' . $user->id . ' by user ' . Auth::user()->id);

            return back();
        }
    }

    public function handleUpdate(User $user, Request $request)
    {
        $data = $request->validate(self::$validationUpdateSchema);

        if (Helpers::checkUserNameIsExist($data['username'], $user->username)) {
            Log::warning('Username is exists: ' . $data['username']);

            return back()->withErrors([
                'username' => 'Username sudah ada'
            ]);
        } else {
            if ($data['password'] === null) {
                unset($data['password']);
            } else {
                $data['password'] = Hash::make($data['password']);
            }

            $user->update($data);

            Log::info('Update user: ' . $user->id . ' with ' . json_encode($data) . ' by user ' . Auth::user()->id);

            return back();
        }
    }

    public function handleDelete(User $user)
    {
        $user->delete();

        Log::info('Delete user: ' . $user->id . ' by user ' . Auth::user()->id);

        return back();
    }
}
