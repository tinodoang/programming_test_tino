<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 5;
        if (strlen($katakunci)) {
            $data = kategori::where(function ($query) use ($katakunci) {
                $query->where('nama_kategori', 'like', "%$katakunci%");
            })->paginate($jumlahbaris);

            if ($data->isEmpty()) {
                return redirect()->back()->with('info', 'Data tidak ditemukan');
            }
        } else {
            $data = kategori::orderBy('id', 'desc')
                ->paginate($jumlahbaris);
        }
        return view('kategori.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ], [
            'nama_kategori.required' => 'Nama Kategori Harus Diisi',
        ]);

        $data = [
            'nama_kategori' => $request->nama_kategori,
        ];

        kategori::create($data);
        return redirect()->route('kategori.index')->with('tambah', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = kategori::where('id', $id)->firstOrFail();
        return view('kategori.index', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        $kategori = kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            kategori::where('nama_kategori', $id)->delete();
            return redirect()->route('kategori.index')
                ->with('success', 'Berhasil menghapus data Kategori.');
        } catch (\Exception $e) {
            return redirect()->route('kategori.index')
                ->with('error', 'Gagal menghapus data Kategori.');
        }
    }
}
