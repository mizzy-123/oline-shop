<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class JenisProductController extends Controller
{
    public function index()
    {
        $jenis_product = Category::orderByDesc('updated_at')->get();
        return view('dashboard.pages.category', [
            'jenis' => $jenis_product
        ]);
    }

    public function add()
    {
        return view('dashboard.pages.tambah-category');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories'
        ]);


        Category::create($validated);

        return redirect()->route('jenis-product.index')->with('succes', 'Jenis Product berhasil ditambahkan');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('succes', 'Jenis Product berhasil dihapus');
    }

    public function edit(Category $category)
    {
        return view('dashboard.pages.edit-category', [
            'category' => $category
        ]);
    }

    public function update(Category $category, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories'
        ]);

        $category->update($validated);

        return redirect()->route('jenis-product.index')->with('succes', 'Jenis Product berhasil diupdate');
    }
}
