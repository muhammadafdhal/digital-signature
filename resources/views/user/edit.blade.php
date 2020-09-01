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
                            <li class="breadcrumb-item active" aria-current="page">Form Edit User</li>
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
                    <form method="POST" action="/user/edit/{{$user->id}}/save" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="inputText1" class="col-form-label">Masukan Nama</label>
                        <input id="inputText1" type="text" value="{{$user->name}}" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="inputText5" class="col-form-label">Masukan Email</label>
                            <input id="inputText5" name="email" value="{{$user->email}}" type="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="inputText2" class="col-form-label">Masukan Password</label>
                            <input id="inputText2" type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                                <label for="inputText3" class="col-form-label">Ulangi Password</label>
                                <input id="inputText3" type="password" name="password_confirmation"
                                    class="form-control" required>
                            </div>

                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="/user" class="btn btn-secondary" data-dismiss="modal">Batal</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
