<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    // 1. Tampilkan tabel daftar paket laundry
    public function index()
    {
        $packages = Package::latest()->paginate(10);
        return view('admin.packages.index', compact('packages'));
    }

    // 2. Tampilkan form tambah paket laundry baru
    public function create()
    {
        return view('admin.packages.create');
    }

    // 3. Simpan paket laundry baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'required|string',
            'estimate'    => 'nullable|string|max:100',
        ]);

        Package::create($request->all());

        return redirect()->route('packages.index')->with('success', 'Data paket laundry berhasil ditambahkan!');
    }

    // 4. Tampilkan form edit paket laundry
    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    // 5. Simpan perubahan paket laundry yang diedit
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'required|string',
            'estimate'    => 'nullable|string|max:100',
        ]);

        $package->update($request->all());

        return redirect()->route('packages.index')->with('success', 'Data paket laundry berhasil diperbarui!');
    }

    // 6. Hapus paket laundry dari database
    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('packages.index')->with('success', 'Data paket laundry berhasil dihapus!');
    }
}