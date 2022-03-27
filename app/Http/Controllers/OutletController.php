<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OutletController extends Controller
{
    static private $validationCreateSchema = [
        'nama_user' => ['required', 'min:3', 'max:100'],
        'nama_outlet' => ['required', 'min:3', 'max:100'],
        'tlp' => ['required', 'min:10', 'max:15'],
        'alamat' => ['required', 'min:10'],
        'username' => ['required', 'min:3', 'max:30'],
        'password' => ['required', 'min:8'],
    ];

    static private $validationUpdateSchema = [
        'nama' => ['required', 'min:3', 'max:100'],
        'tlp' => ['required', 'min:10', 'max:15'],
        'alamat' => ['required', 'min:10'],
    ];

    public function viewOutlet()
    {
        $outlet = Auth::user()->outlet;
        $users = $outlet->user->groupBy('role');
        $packages = $outlet->package;

        return view('dashboard.outlet.index', [
            'outlet' => $outlet,
            'packages' => $packages,
            'casiers' => $users['kasir'] ?? [],
            'admins' => $users['admin'] ?? [],
            'owners' => $users['owner'] ?? [],
        ]);
    }

    public function viewCreate() {
        return view('auth.create-outlet');
    }

    public function handleCreate(Request $request)
    {
        $data = $request->validate(self::$validationCreateSchema);

        $outlet = Outlet::create([
            'nama' => $data['nama_outlet'],
            'tlp' => $data['tlp'],
            'alamat' => $data['alamat'],
        ]);

        $outlet->user()->create([
            'nama' => $data['nama_user'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role' => 'admin'
        ]);

        return redirect()->route('login');
    }

    public function handleUpdate(Request $request) {
        $validatedData = $request->validate(self::$validationUpdateSchema);

        Auth::user()->outlet->update($validatedData);

        return back();
    }
}
