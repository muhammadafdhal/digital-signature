@extends('template.app')

@section('content')

<div class="container-fluid  dashboard-content">

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Form Verifikasi </h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Form</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form Verifikasi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="card">
                <center>
                    <div class="card-header d-flex">
                        <h2 class="mb-0 text-success"><strong> Dokumen Valid </strong><i
                                class="fas fa-check-circle"></i></h2>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><strong> Dokumen <strong class="badge badge-info">{{$namaFile1 }}</strong>
                                yang anda upload dinyatakan benar memiliki
                                tandatangan
                                digital. </strong></p>
                        <p><strong>
                                ini adalah hasil signature yang dihasilkan. </strong></p>
                        <p><strong class="badge badge-primary">{{$lib->toBase64()}}</strong></p>
                        <br>

                        <embed src ="/berkas-verify/{{$namaFile1}}#toolbar=0&navpanes=0&scrollbar=0" type ="application/pdf" width ="100%" height ="600px" />

                    </div>
                </center>
            </div>
        </div>
    </div>
</div>

@endsection
