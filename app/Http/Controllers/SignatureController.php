<?php

namespace App\Http\Controllers;

use App\Signature;
use App\Dokumen;
use Illuminate\Http\Request;
use Alert;

class SignatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($dk_id)
    {
        //
        $dok = Dokumen::findOrFail($dk_id);
        $id = $dok->dk_id;
        return view('kunci.signature', compact('dok','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //

        $dok = Dokumen::findOrFail($id);
        $dok->dk_status = 'Ditandatangani';
        $dok->save();

        $ttd = new Signature;
        $ttd->sg_dk_id = $id;
        $signature = $request['signature'];
        $signatureFileName = uniqid().'.png';
        $signature = str_replace('data:image/png;base64,', '', $signature);
        $signature = str_replace(' ', '+', $signature);
        $data = base64_decode($signature);
        $file = 'ttd/'.$signatureFileName;
        file_put_contents($file, $data);
        $ttd->sg_signature = $signatureFileName;
        $ttd->save();

        return redirect('/dokumen')->with('success', 'Data Berhasil Ditandatangani');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Signature  $signature
     * @return \Illuminate\Http\Response
     */
    public function show(Signature $signature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Signature  $signature
     * @return \Illuminate\Http\Response
     */
    public function edit(Signature $signature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Signature  $signature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Signature $signature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Signature  $signature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Signature $signature)
    {
        //
    }
}
