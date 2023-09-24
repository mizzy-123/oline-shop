<?php

namespace App\Http\Controllers;

use App\Models\Shipper;
use Illuminate\Http\Request;

class ShipperController extends Controller
{
    public function index()
    {
        $shipper = Shipper::all();

        return view('dashboard.pages.shipper', [
            'shipper' => $shipper
        ]);
    }

    public function add()
    {
        return view('dashboard.pages.tambah-shipper');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'harga' => 'required',
            'description' => 'required'
        ]);

        $jumlah = str_replace("Rp ", "", $validated['harga']); // Menghapus "Rp "
        $jumlah = str_replace(".", "", $jumlah); // Menghapus titik (.)
        $harga = (int)$jumlah;

        $validated['harga'] = intval($harga);

        Shipper::create($validated);

        return redirect()->route('shipp.index')->with('succes', 'Berhasil ditambahkan');
    }

    public function edit(Shipper $shipper)
    {
        return view('dashboard.pages.edit-shipper', [
            'shipper' => $shipper
        ]);
    }

    public function update(Shipper $shipper, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'harga' => 'required',
            'description' => 'required'
        ]);

        $jumlah = str_replace("Rp ", "", $validated['harga']); // Menghapus "Rp "
        $jumlah = str_replace(".", "", $jumlah); // Menghapus titik (.)
        $harga = (int)$jumlah;

        $validated['harga'] = intval($harga);

        $shipper->update($validated);

        return redirect()->route('shipp.index')->with('succes', 'Berhasil diupdate');
    }

    public function destroy(Shipper $shipper)
    {
        $shipper->delete();

        return back()->route('shipp.index')->with('succes', 'Berhasil di delete');
    }
}
