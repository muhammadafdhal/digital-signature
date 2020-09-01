@extends('template.app')

@section('content')

<div class="container-fluid  dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Data Tabel</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tabel</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Tabel User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- ============================================================== -->
        <!-- basic table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Tabel User</h5>

                <div class="card-body">

                    {{-- @if(session('sukses'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('sukses')}}</strong>
                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                @endif

                @if(session('tandaTangan'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('tandaTangan')}}</strong>
                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                @endif --}}
                @include('sweet::alert')

                @if (Auth::user()->name == "admin")
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalInput">
                    <i class="fab fa-wpforms"></i> Input Data User
                </a>
                <br><br>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr align="center">
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                @if (Auth::user()->name == "admin")
                                <th>Aksi</th>
                                @endif

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                $no = 1;
                                ?>

                            @foreach ($user as $t)

                            @if ($t->id != Auth::user()->id)
                            <tr align="center">
                                <td>{{$no++}}.</td>
                                <td>{{$t->name}}</td>
                                <td>{{$t->email}}</td>
                                @if (Auth::user()->name == "admin")
                                <td>
                                    <a href="/user/edit/{{$t->id}}" data-toggle="tooltip" title="Edit"
                                        class="btn btn-success"><i class="fas fa-edit"></i></a>
                                    <form method="POST" onclick="return confirm('Yakin Ingin Menghapus Data Ini ?')"
                                        action="/user/delete/{{ $t->id }}">
                                        {{csrf_field()}} {{method_field('DELETE')}}

                                        <button type="submit" data-toggle="tooltip" title="Hapus"
                                            class="btn btn-danger mt-2"><i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- modal form input user --}}
                <div class="modal fade" id="modalInput" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Modal title
                                </h5>
                                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="/user/tambah/save" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="inputText1" class="col-form-label">Masukan Nama</label>
                                        <input id="inputText1" type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText5" class="col-form-label">Masukan Email</label>
                                        <input id="inputText5" name="email" type="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText2" class="col-form-label">Masukan Password</label>
                                        <input id="inputText2" type="password" name="password" class="form-control"
                                            required>
                                    </div>

                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Batal</a>

                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        $('#form-tambah').on('submit', function (e) {
                            var form = this;
                            e.preventDefault();
                            swal({
                                title: 'Apakah Data Sudah Benar ?',
                                text: "Klik OK untuk menambahkan data !",
                                icon: 'info',
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Hapus'
                            }).then((isConfirm) => {
                                if (isConfirm) {
                                    return form.submit();
                                }
                            })
                        });

                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
