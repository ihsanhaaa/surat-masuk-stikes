<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\SuratPenting;
use Illuminate\Http\Request;

class SuratPentingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surats = Surat::where('kategori_berkas', 'Surat Penting')->get();

        return view('surat.index_surat_penting',compact('surats'));
    }

    public function store(Request $request)
    {
        // dd($request);

        $request->validate([
            'nama_berkas' => 'required|string|max:255',
            'nomor_berkas' => 'required|string|max:255',
            'tanggal_berkas' => 'required|date',
            'kategori_berkas' => 'required',
            'file_berkas' => 'required|mimes:pdf,docx|max:2048',
        ]);

        $file = $request->file('file_berkas');
        if ($file) {

            $cleanedName = preg_replace('/[^A-Za-z0-9\-]/', '_', $request->nama_berkas);
            $cleanedKategori = preg_replace('/[^A-Za-z0-9\-]/', '_', $request->kategori_berkas);

            $filename = $cleanedKategori . '-' . $cleanedName . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = 'Berkas/' . $filename;

            $file->move(public_path('Berkas'), $filename);

            $surat = new Surat();
            $surat->nama_berkas = $request->input('nama_berkas');
            $surat->nomor_berkas = $request->input('nomor_berkas');
            $surat->kategori_berkas = $request->input('kategori_berkas');
            $surat->tanggal_berkas = $request->input('tanggal_berkas');
            $surat->file_berkas = $filename;
            $surat->save();

            return back()->with('success', 'Surat Masuk berhasil ditambahkan');
        }

        return back()->with('error', 'Gagal menambahkan Surat Masuk.');
    }
    
    public function destroy(SuratPenting $suratPenting)
    {
        //
    }
}
