<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <style type="text/css">
        @font-face {
            font-family: 'Edwardian Script ITC';
            font-style: normal;
            font-weight: normal;
            src: url(http://" . $_SERVER['SERVER_NAME']."/dompdf/fonts/ITCEDSCR.ttf) format('truetype');
        }

    </style> --}}
</head>

<body>
    <?php
        $tgl = $dw->created_at;
        $tgl_lahir = $dw->dk_tglLahir;
     
        $bulan = array (1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
        );

        $split = explode('-', $tgl);
        $split_tgl_lahir = explode('-',$tgl_lahir);


        ?>


    <p style="text-align: center;">SURAT WASIAT WARIS</p>
    <p>&nbsp;</p>
    <p>Kami Yang Bertanda Tangan Di Bawah Ini :</p>
    <p>Nama&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;: {{$dw->dk_nama}}</p>
    <p>Tempat Lahir&nbsp;: {{$dw->dk_tempatLahir}}</p>
    <p>Tanggal Lahir&nbsp;:
        {{$split_tgl_lahir[2] . ' ' . $bulan[ (int)$split_tgl_lahir[1] ] . ' ' . $split_tgl_lahir[0]   }}&nbsp;</p>
    <p>&nbsp;</p>
    <p>Sebagai Ayah Angkat</p>
    <p>Saya dengan sadar dan tidak ada paksaan membuat Pernyataan Surat Wasiat Waris atau Hibah Harta Saya, kepada anak
        &ndash; anak angkat saya, yang telah saya sebutkan yaitu :</p>
    <?php 
        $no = 1;
        ?>
    @foreach ($anak as $t)
    <ol start="{{$no++}}">
        <li>{{$t}}&nbsp;</li>
    </ol>
    @endforeach
    <p>Untuk menyerahkan sebagian harta saya kepada mereka yang tertulis dibawah ini:</p>
    <p>Rumah yang saya diami sekarang ini dan tanah perumahan yang ada didepan rumah saya beserta Perkebunan yang ada
        dibelakang rumah saya Apabila saya sudah tidak ada, dengan ketentuan harta itu digunakan, untuk menyelesaikan
        semua
        permesalahan utang piutang saya jika ada, 30 % saya wakafkan dari sisa harta keseluruhan, Dan harta yang tersisa
        dari penggunaan yang telah disebut, maka saya serahkan dengan pembagian rata kepada anak angkat saya yang telah
        saya
        sebutkan.</p>
    <p>Demikianlah surat pernyataan Wasiat waris atau hibah harta saya buat,dengan penuh kesadaran dan tidak ada paksaan
        dari pihak lain.</p>
    <p style="text-align: center;">
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{$dw->dk_tempatLahir}},
        {{ date('d'). ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0]   }}&nbsp;</p>
    <p style="text-align: right;">Yang Berwasiat Waris Ayah Angkat&nbsp;</p>
    <p style="text-align: center; font-size: 20px; font-family: cursive;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        <img src="{{ base_path() }}/public/ttd/{{$sg[0]->sg_signature}}" height="100" />&nbsp;</p>
    <p style="text-align: center; font-size: 20px;">
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{$dw->dk_nama}}</p>

</body>

</html>
