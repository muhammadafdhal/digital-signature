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
        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <center>
                        <h3 class="card-title">Verifikasi Surat</h3>
                        <p class="card-text">Upload File Surat yang ingin anda verifikasi.</p>
                        <form action="/verifikasi/save" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="frame">
                                <div class="center">
                                    <div class="dropzone">
                                        
                                        <input type="file" name="dok"  />
                                    </div>
                                    <br>

                                    <button type="submit" class="btn btn-primary col-lg-10" name="uploadbutton">Upload
                                        file</button>

                                </div>
                            </div>
                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>
        
    {{-- <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="card">

                <center>
                    <div class="card-header d-flex">
                        <h2 class="mb-0 text-success"><strong> Dokumen Valid </strong><i
                                class="fas fa-check-circle"></i></h2>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><strong> Dokumen (nama file) yang anda upload dinyatakan benar memilii
                                tandatangan
                                digital
                                atau dokumen tersebut telah dirubah.</strong></p>
                    </div>
                </center>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="card">

                <center>
                    <div class="card-header d-flex">
                        <h2 class="mb-0 text-danger"><strong> Dokumen Tidak Valid </strong><i
                                class="fas fa-exclamation-circle"></i></h2>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><strong> Dokumen (nama file) yang anda upload tidak memiliki tandatangan
                                digital
                                atau dokumen tersebut telah dirubah.</strong></p>
                    </div>
                </center>
            </div>
        </div>
    </div> --}}

    

    {{-- <div class="row">
        <!-- ============================================================== -->
        <!-- validation form -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Bootstrap Validation Form</h5>
                <div class="card-body">
                    <form class="needs-validation" novalidate>
                        <div class="form-group">
                            <input type="file" accept=".pdf" name="dk_dokumen">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end validation form -->
        <!-- ============================================================== -->
    </div> --}}
</div>

@endsection
