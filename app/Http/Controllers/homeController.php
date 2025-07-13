<?php

namespace App\Http\Controllers;

use App\Models\detailTransaksi;
use App\Models\Kategori;
use App\Models\produk;
use App\Models\transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    $jumlahUser = User::count();
    $jumlahProduk = produk::count();
    $jumlahKategori = Kategori::count();
    $totalPendapatan = detailTransaksi::sum('subtotal'); // sesuaikan kolom jika berbeda

    return view('home', compact('jumlahUser', 'jumlahProduk', 'jumlahKategori', 'totalPendapatan'));
}
}
