<?php

namespace App\Http\Controllers;

use Auth;
use EllipticCurve;
use App\Dokumen;
use App\Signature;
use Illuminate\Http\Request;
use File;
use PDF;
use App\User;
use Alert;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        
        $dok = Dokumen::all();
        return view('dokumen.index', compact('dok'));

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
    public function store(Request $request)
    {
        //
        $dok = new Dokumen;
        $berkas1 = $request->file('dk_dokumen');
        $namaFile1 = $berkas1->getClientOriginalName();
        $request->file('dk_dokumen')->move('berkas/', $namaFile1);
        $dok->dk_dokumen= $namaFile1;
        $dok->save();
        return redirect('/dokumen')->with('success', 'Dokumen Berhasil Di Upload');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function show(Dokumen $dokumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokumen $dokumen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dokumen $dokumen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokumen $dokumen)
    {
        //
    }

    public function tandaTangan($dk_id)
    {

        # Generate privateKey from PEM string
        $privateKey = EllipticCurve\PrivateKey::fromPem("
        -----BEGIN EC PARAMETERS-----
        BgUrgQQACg==
        -----END EC PARAMETERS-----
        -----BEGIN EC PRIVATE KEY-----
        MHQCAQEEIODvZuS34wFbt0X53+P5EnSj6tMjfVK01dD1dgDH02RzoAcGBSuBBAAK
        oUQDQgAE/nvHu/SQQaos9TUljQsUuKI15Zr5SabPrbwtbfT/408rkVVzq8vAisbB
        RmpeRREXj5aog/Mq8RrdYy75W9q/Ig==
        -----END EC PRIVATE KEY-----
        ");

        
        # Create message from json

        $publicKey = $privateKey->publicKey();
        
        $data = Dokumen::find($dk_id);

        $data->dk_status = 'Ditandatangani';
        $data->save();

        $file = File::get('berkas/'.$data->dk_dokumen);
        
        
        $parag = fopen('berkas/'.$data->dk_dokumen, "a");
        
        
        $signature = EllipticCurve\Ecdsa::sign($file, $privateKey);
        
        fwrite($parag, $signature->toBase64());
        fclose($parag);
        
        
        
        $verify = EllipticCurve\Ecdsa::verify($file, $signature, $publicKey);
        
        # Generate Signature in base64. This result can be sent to Stark Bank in header as Digital-Signature parameter

        // $ttd = new Signature;
        // $ttd->sg_signature = $signature->toBase64();
        // $ttd->save();
        // var_dump($publicKey);
        // dd($file);

        // # To double check if message matches the signature
        // $publicKey = $privateKey->publicKey();

        // echo "\n" . EllipticCurve\Ecdsa::verify($message, $signature, $publicKey);

        return redirect('/dokumen')->with('tandaTangan', 'Dokumen Berhasil Di Tandatangani');
    }

    public function verifikasi()
    {
        return view('verifikasi.index');
    }

    public function verifyDokumen(Request $request)
    {
        
        

        $berkas1 = $request->file('dok');
        $namaFile1 = $berkas1->getClientOriginalName();
        $request->file('dok')->move('berkas-verify/', $namaFile1);
        $file = file_get_contents('berkas-verify/'.$namaFile1);
        $ttd=explode('EOF',$file);
        $ttd2=substr($ttd[1],0,1);
        $dokumen=$ttd[0].'EOF'.$ttd2;
        $ttd1=substr($ttd[1],1);

        $privateKey = EllipticCurve\PrivateKey::fromPem("
        -----BEGIN EC PARAMETERS-----
        BgUrgQQACg==
        -----END EC PARAMETERS-----
        -----BEGIN EC PRIVATE KEY-----
        MHQCAQEEIODvZuS34wFbt0X53+P5EnSj6tMjfVK01dD1dgDH02RzoAcGBSuBBAAK
        oUQDQgAE/nvHu/SQQaos9TUljQsUuKI15Zr5SabPrbwtbfT/408rkVVzq8vAisbB
        RmpeRREXj5aog/Mq8RrdYy75W9q/Ig==
        -----END EC PRIVATE KEY-----
        ");

        $publicKey = $privateKey->publicKey();

        $lib =  EllipticCurve\Signature::fromBase64($ttd1);
        $veri=EllipticCurve\Ecdsa::verify($dokumen, $lib, $publicKey);
        // dd($veri);


        if ($veri == true) {
            return view('verifikasi.valid', compact('namaFile1','lib','file'));
        }
        else {
            return view('verifikasi.unvalid', compact('namaFile1'));
        }

    }

    public function inputDataWasiat(Request $request)
    {

        $anak = json_encode($request->dk_anak);
        $dw = new Dokumen;
        $dw->dk_nama = $request['dk_nama'];
        $dw->dk_user_id = Auth::user()->id;
        $dw->dk_noKtp = $request['dk_noKtp'];
        $dw->dk_tempatLahir = $request['dk_tempatLahir'];
        $dw->dk_tglLahir = $request['dk_tglLahir'];
        $dw->dk_alamat = $request['dk_alamat'];
        $dw->dk_anak = $anak;
        $dw->save();
        return redirect('/dokumen')->with('success', 'Data Berhasil Diinput');

    }

    public function createDataAnak($dk_id)
    {
        $dw = Dokumen::findOrFail($dk_id);
        $jumlah = $dw->dk_anak;
        return view('dokumen.inputAnak', compact('dw','jumlah'));
    }

    public function inputDataAnak(Request $request, $dk_id)
    {
        $nama = $request->dk_nama_anak;
        $dw = Dokumen::findOrFail($dk_id);
        $hasil = '';
        for ($i=0; $i < count($nama); $i++) { 
            if ($i == count($nama)-1) 
            {
                $hasil.=$nama[$i];
            }
            else
            {
                $hasil.=$nama[$i].',';
            }
        }
        $dw->dk_nama_anak = $hasil;
        $dw->dk_anak_status = 'sudah';
        $dw->save();
        return redirect('/dokumen')->with('success', 'Data Berhasil Diinput');
        
    }

    public function cetak_surat($dk_id)
    {

        $dw = Dokumen::findOrFail($dk_id);
        $sg = Signature::join('dokumens','dokumens.dk_id','=','signatures.sg_dk_id')->where('sg_dk_id','=', $dk_id)->get();
        $anak = json_decode($dw->dk_anak);
        // $anak = explode(",", $anak_anak);

        $pdf = PDF::setOptions(['isPhpEnabled' => true])->loadview('/dokumen/surat-wasiat',['dw'=>$dw, 'anak'=>$anak, 'sg'=>$sg])->setPaper('a4','potrait')->setWarnings(false);
        $output = $pdf->output();
        file_put_contents('berkas/'.$dw->dk_nama.'-surat-wasiat.pdf',$output);
        // return $pdf->download('Surat Wasiat');

        $privateKey = EllipticCurve\PrivateKey::fromPem("
        -----BEGIN EC PARAMETERS-----
        BgUrgQQACg==
        -----END EC PARAMETERS-----
        -----BEGIN EC PRIVATE KEY-----
        MHQCAQEEIODvZuS34wFbt0X53+P5EnSj6tMjfVK01dD1dgDH02RzoAcGBSuBBAAK
        oUQDQgAE/nvHu/SQQaos9TUljQsUuKI15Zr5SabPrbwtbfT/408rkVVzq8vAisbB
        RmpeRREXj5aog/Mq8RrdYy75W9q/Ig==
        -----END EC PRIVATE KEY-----
        "); 

        
        # Create message from json

        $publicKey = $privateKey->publicKey();

        $dw->dk_dokumen = 'Dicetak';
        $dw->save();

        $file = File::get('berkas/'.$dw->dk_nama.'-surat-wasiat.pdf');
        
        
        $parag = fopen('berkas/'.$dw->dk_nama.'-surat-wasiat.pdf', "a");
        
        
        $signature = EllipticCurve\Ecdsa::sign($file, $privateKey);
        
        fwrite($parag, $signature->toBase64());
        fclose($parag);
        
        
        $verify = EllipticCurve\Ecdsa::verify($file, $signature, $publicKey);

        return redirect('berkas/'.$dw->dk_nama.'-surat-wasiat.pdf');


    }
}
