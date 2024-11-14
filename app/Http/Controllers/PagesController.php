<?php

namespace App\Http\Controllers;

use App\Models\TempatParkir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index()
    {
        return view('index');
    }
}
