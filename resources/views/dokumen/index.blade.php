@extends('template.app')

@section('dokumen')
active
@endsection

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

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
                            <li class="breadcrumb-item active" aria-current="page">Data Tabel</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Tabel Dokumen Wasiat</h5>

                <div class="card-body">

                @include('sweet::alert')

                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalInput">
                    <i class="fab fa-wpforms"></i> Input Data
                </a>
                <br><br>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr align="center">
                                <th>No.</th>
                                <th>Nama</th>
                                <th>No. KTP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                    $no = 1;
                                ?>
                            @foreach ($dok as $t)

                            @if ($t->dk_user_id == Auth::user()->id)
                            <tr align="center">
                                <td>{{$no++}}</td>
                                <td>{{$t->dk_nama}}</td>
                                <td>{{$t->dk_noKtp}}</td>
                                <td>
                                    {{-- @if ($t->dk_status == "Belum" && $t->dk_anak_status == "belum" && $t->dk_dokumen
                                    == null)
                                    <a href="/dokumen/anak/{{$t->dk_id}}" class="btn btn-info">
                                        <i class="fab fa-wpforms"></i> Input Data Anak
                                    </a> --}}

                                    @if ($t->dk_status == "Belum" &&
                                    $t->dk_dokumen == null)
                                    <a href="/signature/{{$t->dk_id}}" data-toggle="tooltip" title="TandaTangani" class="btn btn-success"><i
                                            class="fas fa-pencil-alt"></i></a>

                                    @elseif ($t->dk_status == "Ditandatangani" &&
                                    $t->dk_dokumen == null)
                                    <a href="/dokumen/cetak_wasiat/{{$t->dk_id}}" data-toggle="tooltip" title="Cetak" class="btn btn-success"><i
                                            class="fas fa-print"></i></a>

                                    @elseif ($t->dk_status == "Ditandatangani" &&
                                    $t->dk_dokumen == "Dicetak")
                                    <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                    @endif

                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title
                                </h5>
                                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="/dokumen/tambah/save" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <input type="file" accept=".pdf" name="dk_dokumen">
                                    </div>

                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Batal</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- modal untuk mengisi pada surat wasiat --}}
                <div class="modal fade" id="modalInput" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Input Data Wasiat
                                </h5>
                                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                            </div>
                            <div class="modal-body">
                                <form id="form-tambah" method="POST" action="/dokumen/wasiat/save"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="inputText1" class="col-form-label">Masukan Nama Lengkap</label>
                                        <input id="inputText1" type="text" name="dk_nama" class="form-control" required
                                            autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText5" class="col-form-label">Masukan No.KTP</label>
                                        <input id="inputText5" name="dk_noKtp" type="number" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText2" class="col-form-label">Masukan Tempat Lahir</label>
                                        <input id="inputText2" type="text" name="dk_tempatLahir" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Masukan Tanggal Lahir</label>
                                        <input id="inputText3" type="date" name="dk_tglLahir" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <table class="" id="dynamic_field">
                                            <label class="col-form-label">Masukan Nama Anak</label>
                                            <tr>
                                                <td width="800px"><input type="text" name="dk_anak[]" placeholder=""
                                                        class="form-control name_list" /></td>
                                                <td><button type="button" name="add" id="add"
                                                        class="btn btn-success"><i class="fas fa-plus"></i></button></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText4">Masukan Alamat</label>
                                        <textarea class="form-control" name="dk_alamat" id="inputText4" rows="3"
                                            required></textarea>
                                    </div>


                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Batal</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function () {
                        var i = 1;
                        $('#add').click(function () {
                            i++;
                            $('#dynamic_field').append('<tr id="row' + i +
                                '"><td><input type="text" name="dk_anak[]" placeholder="" class="form-control name_list" /></td><td><button type="button" name="remove" id="' +
                                i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
                        });
                        $(document).on('click', '.btn_remove', function () {
                            var button_id = $(this).attr("id");
                            $('#row' + button_id + '').remove();
                        });
                    });

                </script>
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
    <!-- ============================================================== -->
    <!-- end basic table  -->
    <!-- ============================================================== -->
</div>

</div>

@endsection
