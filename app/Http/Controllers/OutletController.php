<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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

        Log::info('View outlet data: ' . $outlet->id . ' by user ' . Auth::user()->id);

        return view('dashboard.outlet.index', [
            'outlet' => $outlet,
            'packages' => $packages,
            'casiers' => $users['kasir'] ?? [],
            'admins' => $users['admin'] ?? [],
            'owners' => $users['owner'] ?? [],
        ]);
    }

    public function viewCreate()
    {
        return view('auth.create-outlet');
    }

    public function handleCreate(Request $request)
    {
        $data = $request->validate(self::$validationCreateSchema);

        if (Helpers::checkOutletNameIsExist($data['nama_outlet'])) {
            Log::warning('Outlet name is exists: ' . $data['nama_outlet']);

            return back()->withErrors([
                'nama_outlet' => 'Nama outlet sudah ada'
            ]);
        } else {
            if (Helpers::checkUserNameIsExist($data['username'])) {
                Log::warning('Username is exists: ' . $data['username']);

                return back()->withErrors([
                    'username' => 'Username sudah ada'
                ]);
            } else {
                $outlet = Outlet::create([
                    'nama' => $data['nama_outlet'],
                    'tlp' => $data['tlp'],
                    'alamat' => $data['alamat'],
                ]);

                Log::info('Create outlet: ' . $outlet->id);

                $user = $outlet->user()->create([
                    'nama' => $data['nama_user'],
                    'username' => $data['username'],
                    'password' => Hash::make($data['password']),
                    'role' => 'admin'
                ]);

                Log::info('Create user: ' . $user->id);

                return redirect()->route('login');
            }
        }
    }

    public function handleUpdate(Request $request)
    {
        $data = $request->validate(self::$validationUpdateSchema);

        if (Helpers::checkOutletNameIsExist($data['nama'], Auth::user()->outlet->nama)) {
            Log::warning('Outlet name is exists: ' . $data['nama_outlet']);

            return back()->withErrors([
                'nama' => 'Nama outlet sudah ada'
            ]);
        } else {
            Auth::user()->outlet->update($data);

            Log::info('Update outlet: ' . Auth::user()->outlet->id . ' with ' . json_encode($data) . ' by user ' . Auth::user()->id);

            return back();
        }
    }
}
