<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Dokumen;
use Auth;

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
        $surat_masuk = Dokumen::all();
        $surat_masuk1 = Dokumen::where('dk_status',['Ditandatangani'])->get();
        $jumlah_surat = count($surat_masuk);
        $jumlah_ditandatangani = count($surat_masuk1);
        return view('dashboard', compact('jumlah_surat','jumlah_ditandatangani'));
    }
}
