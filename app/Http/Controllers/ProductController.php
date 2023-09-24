<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FotoProduct;
use App\Models\Product;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::orderByDesc('created_at')->paginate(6);

        $category = Category::all();

        return view('dashboard.pages.product', [
            'product' => $product,
            'categories' => $category
        ]);
    }

    public function add()
    {
        $category = Category::all();
        return view('dashboard.pages.tambah-product', [
            'categories' => $category
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'harga' => 'required',
            'qty' => 'required|integer',
            'foto.*' => 'image|file',
            'category' => 'required'
        ]);

        $slug = SlugService::createSlug(Product::class, 'slug', $validated['name']);

        $jumlah = str_replace("Rp ", "", $validated['harga']); // Menghapus "Rp "
        $jumlah = str_replace(".", "", $jumlah); // Menghapus titik (.)
        $harga = (int)$jumlah;

        $product = Product::create([
            'name' => $validated['name'],
            'category_id' => $validated['category'],
            'slug' => $slug,
            'description' => $validated['description'],
            'harga' => intval($harga),
            'qty' => $validated['qty']
        ]);

        if ($product) {
            if ($request->hasFile('foto')) {
                foreach ($request->file('foto') as $file) {
                    if ($file->isValid()) {
                        $gambar = $file->store('gambar-product');

                        // Simpan nama file ke database
                        $photo = new FotoProduct;
                        $photo->foto = $gambar;
                        // Tambahkan kolom lain yang diperlukan
                        $product->fotoProduct()->save($photo);
                    } else {
                        // File tidak valid, lakukan penanganan kesalahan di sini
                        return back()->with('error', 'File tidak valid.');
                    }
                }
            }
        }

        return redirect()->route('product.index')->with('succes', 'Berhasil ditambahkan');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'harga' => 'required',
            'category' => 'required'
        ]);


        $jumlah = str_replace("Rp ", "", $validated['harga']); // Menghapus "Rp "
        $jumlah = str_replace(".", "", $jumlah); // Menghapus titik (.)
        $harga = (int)$jumlah;

        if ($request->name == $product->name) {
            $product->update([
                'name' => $validated['name'],
                'category_id' => $validated['category'],
                'description' => $validated['description'],
                'harga' => intval($harga),
            ]);
        } else {
            $slug = SlugService::createSlug(Product::class, 'slug', $validated['name']);
            $product->update([
                'name' => $validated['name'],
                'category_id' => $validated['category'],
                'slug' => $slug,
                'description' => $validated['description'],
                'harga' => intval($harga),
            ]);
        }

        return back()->with('succes', 'Berhasil diupdate');
    }

    public function stockUpdate(Request $request, Product $product)
    {
        $validated = $request->validate([
            'qty' => 'required|integer'
        ]);

        $product->update($validated);
        return back()->with('succes', 'Berhasil diupdate');
    }

    public function destroy(Product $product)
    {
        foreach ($product->fotoProduct()->get() as $f) {
            if ($f->foto != null) {
                Storage::delete($f->foto);
            }
        }
        $product->delete();

        return back()->with('succes', 'Berhasil di delete');
    }

    public function editPhoto(Product $product)
    {
        return view('dashboard.pages.gallery-product', [
            'foto_product' => $product->fotoProduct()->get(),
            'product' => $product
        ]);

        // return dd(array_chunk($product->fotoProduct()->get()->toArray(), 4));
    }

    public function updatePhoto(FotoProduct $photo, Request $request)
    {
        $validated = $request->validate([
            'foto' => 'file|image'
        ]);

        if ($request->file('foto')) {
            if ($photo->foto != null) {
                Storage::delete($photo->foto);
            }
            $validated['foto'] = $request->file('foto')->store('gambar-product');
        }
        $photo->update($validated);

        return back()->with('succes', 'Foto berhasil update');
    }

    public function tambahPhoto(Request $request, Product $product)
    {
        $validated = $request->validate([
            'foto' => 'file|image'
        ]);

        if ($request->file('foto')) {
            $validated['foto'] = $request->file('foto')->store('gambar-product');
        }
        $fotoProduct = new FotoProduct;
        $fotoProduct->foto = $validated['foto'];
        $product->fotoProduct()->save($fotoProduct);

        return back()->with('succes', 'Foto berhasil ditambah');
    }

    public function deletePhoto(FotoProduct $photo)
    {
        if ($photo->foto != null) {
            Storage::delete($photo->foto);
        }
        $photo->delete();
        return back()->with('succes', 'Foto berhasil dihapus');
    }
}
