@extends('template.app')

@section('content')

<div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title"> Dashboard </h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader  -->
    <!-- ============================================================== -->

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body border-top">
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Anda Berhasil Login !</h4>
                        <p>Selamat Datang di Sistem Informasi Surat Wasiat Dengan Digital Signature Menggunakan Metode ECDSA</p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- end alerts  -->
        <!-- ============================================================== -->
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">Total Surat Masuk</h5>
                        <h2 class="mb-0"> 
                            {{$jumlah_surat}}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                        <i class="fas fa-archive fa-fw fa-sm text-info"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h5 class="text-muted">Total Surat Ditandatangani</h5>
                        <h2 class="mb-0"> {{$jumlah_ditandatangani}}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
                        <i class="fas fa-pencil-alt fa-fw fa-sm text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
