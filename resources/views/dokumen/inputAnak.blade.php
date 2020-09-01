@extends('template.app')

@section('content')
<div class="container-fluid  dashboard-content">


    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Form</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Form</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form Input Data Anak</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="/dokumen/anak/{{$dw->dk_id}}/save" enctype="multipart/form-data">
                        @csrf

                            @for ($i = 0; $i < $jumlah; $i++)
                                <div class="form-group">
                                    <label for="inputText1" class="col-form-label">Nama Anak ke-{{$i+1}}
                                    </label>
                                    <input id="inputText1" type="text" name="dk_nama_anak[]" class="form-control" required
                                        autofocus>
                                </div>
                            @endfor

                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="/dokumen" class="btn btn-secondary" data-dismiss="modal">Batal</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
