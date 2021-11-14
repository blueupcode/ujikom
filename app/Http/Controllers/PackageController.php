<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
    static private $validationCreateSchema = [
        'nama_paket' => ['required', 'min:3', 'max:100'],
        'jenis' => ['required', 'in:kiloan,selimut,bed_cover,kaos,lain'],
        'harga' => ['required', 'numeric', 'min:1'],
    ];

    static private $validationUpdateSchema = [
        'nama_paket' => ['required', 'min:3', 'max:100'],
        'jenis' => ['required', 'in:kiloan,selimut,bed_cover,kaos,lain'],
        'harga' => ['required', 'numeric', 'min:1'],
    ];

    public function handleCreate(Request $request)
    {
        $data = $request->validate(self::$validationCreateSchema);

        if (Helpers::checkPackageNameIsExists($data['nama_paket'])) {
            Log::warning('Package name is exists: ' . $data['nama_paket']);

            return back()->withErrors([
                'nama_paket' => 'Nama paket sudah ada'
            ]);
        } else {
            $package = Auth::user()->outlet->package()->create($data);

            Log::info('Create package: ' . $package->id . ' by user ' . Auth::user()->id);

            return back();
        }
    }

    public function handleUpdate(Package $package, Request $request)
    {
        $data = $request->validate(self::$validationUpdateSchema);

        if (Helpers::checkPackageNameIsExists($data['nama_paket'], $package->nama_paket)) {
            Log::warning('Package name is exists: ' . $data['nama_paket']);

            return back()->withErrors([
                'nama_paket' => 'Nama paket sudah ada'
            ]);
        } else {
            $package->update($data);

            Log::info('Update package: ' . $package->id . ' with ' . json_encode($data) . ' by user ' . Auth::user()->id);

            return back();
        }
    }

    public function handleDelete(Package $package)
    {
        $package->delete();

        Log::info('Delete package: ' . $package->id . ', by user ' . Auth::user()->id);

        return back();
    }
}
