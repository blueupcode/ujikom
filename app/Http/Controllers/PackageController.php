<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
        Auth::user()->outlet->package()->create($data);

        return back();
    }

    public function handleUpdate(Package $package, Request $request)
    {
        $data = $request->validate(self::$validationUpdateSchema);
       
        $package->update($data);

        return back();
    }

    public function handleDelete(Package $package)
    {
        $package->delete();

        return back();
    }
}
