<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use App\Models\PotensiPendapatan;
use App\Models\Surat;
use App\Models\TargetRealisasi;
use App\Models\TempatParkir;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $tahunSekarang = Carbon::now()->format('Y');

        $suratPerKategori = Surat::selectRaw('kategori_berkas, MONTH(tanggal_berkas) as bulan, COUNT(*) as jumlah')
            ->whereYear('tanggal_berkas', Carbon::now()->year) // Hanya data tahun ini
            ->groupBy('kategori_berkas', 'bulan')
            ->orderBy('bulan')
            ->get();

        // Inisialisasi array untuk setiap kategori berkas
        $kategoriList = ['Surat Masuk', 'Surat Keluar', 'Surat SK', 'Surat Penting', 'Surat Arsip'];

        // Inisialisasi data surat per kategori dan per bulan (semua bulan diisi 0 sebagai default)
        $dataSurat = [];
        foreach ($kategoriList as $kategori) {
            $dataSurat[$kategori] = array_fill(1, 12, 0); // Mengisi tiap bulan (1-12) dengan 0
        }

        // Mengisi jumlah surat sesuai kategori dan bulan dari hasil query
        foreach ($suratPerKategori as $data) {
            $dataSurat[$data->kategori_berkas][$data->bulan] = $data->jumlah;
        }

        // Inisialisasi label bulan (nama bulan)
        $bulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulan[$i] = Carbon::create()->month($i)->format('F'); // Nama bulan
        }

        return view('home', compact('bulan', 'dataSurat', 'tahunSekarang'));
    }
}
