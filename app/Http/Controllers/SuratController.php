<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:list-surat|create-surat|edit-surat|delete-surat', ['only' => ['index','store']]);
        $this->middleware('permission:create-surat', ['only' => ['create','store']]);
        $this->middleware('permission:edit-surat', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-surat', ['only' => ['destroy']]);
    }
    
    public function showSuratByBulan($bulan)
    {
        // Convert bulan to month number (e.g., Januari -> 01)
        $bulanNumber = Carbon::parse("1 $bulan")->format('m');

        // Fetch surat data from database where the month matches
        // Assuming you have a Surat model and 'tanggal_surat' field
        $surats = Surat::whereMonth('tanggal_berkas', $bulanNumber)->get();

        // Pass the data to the view
        return view('surat.surat_bulan', compact('bulan', 'surats'));
    }
}
