@extends('template.app')

@section('content')
<div class="container-fluid  dashboard-content">


    {{-- <?php
        include_once "controllers/ElgamalEllipticCurve.php";
        $titikKurvaDanSymbol = null;
    ?> --}}
    <section class="content-header">
        <h1>
            Pembangkit Kunci<br>
            <small>Digunakan untuk pembangkit kunci</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="?p="><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="?p=pk">Pembangkit Kunci</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Inisialisasi</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row" style="padding-right: 15px">
                    <div class="col-md-4">
                        <form id="form-enkrip" action="/pembangkit-kunci/koef" method="get">
                            <input type="hidden" name="act" value="pk">
                            <div class="form-group">
                                <label for="koef_a" class="control-label">Koef A</label>
                                <input type="number" class="form-control" name="koef_a" value="<?= @$_GET['koef_a'] ?>"
                                    placeholder="Masukkan Koef a">
                            </div>
                            <div class="form-group">
                                <label for="koef_b" class="control-label">Koef B</label>
                                <input type="number" class="form-control" name="koef_b" value="<?= @$_GET['koef_b'] ?>"
                                    placeholder="Masukkan Koef b">
                            </div>
                            <input id="proses" type="submit" class="btn btn-md btn-primary btn-block" value="Proses">
                        </form>
                        <?php
                    if (
                        (isset($_POST['act']) && !empty($_POST['act'])) &&
                        (isset($_POST['koef_a']) && !empty($_POST['koef_a'])) &&
                        (isset($_POST['koef_b']) && !empty($_POST['koef_b'])) &&
                        (isset($_POST['p']) && !empty($_POST['p'])) &&
                        (isset($_POST['x']) && !empty($_POST['x'])) &&
                        (isset($_POST['y']) && !empty($_POST['y'])) &&
                        (isset($_POST['q']['x']) && !empty($_POST['q']['x'])) &&
                        (isset($_POST['q']['y']) && !empty($_POST['q']['y'])) &&
                        (isset($_POST['d']) && !empty($_POST['d']))
                    ) {
                        include_once 'controllers/KeyHelper.php';
                        $privKeyName = "privat-key-" . md5(date('dmY-His')) . ".ecc";
                        $pubKeyName = "public-key-" . md5(date('dmY-His')) . ".ecc";
                        $keyArray = $_POST;
                        unset($keyArray['act']);
                        $keyString = genKey(json_encode($keyArray), $privKeyName);
                        unset($keyArray['d']);
                        $keyString = genKey(json_encode($keyArray), $pubKeyName);
                        ?>
                        <div class="callout callout-success" style="margin-top: 10px">
                            <h4>Kunci Public dan Privat Berhasil Dibuat</h4>
                            <div>
                                <a href="controllers/key-gen.php?name=<?= $privKeyName ?>" download="privat-key.ecc"
                                    class="btn btn-md btn-warning">
                                    <i class="fa fa-download"></i>&nbsp;&nbsp;Kunci Privat
                                </a>
                                <a href="controllers/key-gen.php?name=<?= $pubKeyName ?>" download="public-key.ecc"
                                    class="btn btn-md btn-success">
                                    <i class="fa fa-download"></i>&nbsp;&nbsp;Kunci Public
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                    <?php
                if ((isset($_GET['act']) && $_GET['act'] == 'pk')
                    && (isset($_GET['koef_a']) && isset($_GET['koef_b']))
                    && (!empty($_GET['koef_a']) && !empty($_GET['koef_b']))) {
                    ?>
                    <div class="col-md-4" id="respon-pke" style="height: 350px;overflow-y: scroll">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">X</th>
                                    <th class="text-center">Y</th>
                                    <th class="text-center">Pilih</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $pilihTitik = titikKurva(37, $_GET['koef_a'], $_GET['koef_b']);
                            foreach ($pilihTitik as $row => $value) { ?>
                                <tr>
                                    <td class="text-center"><?= $value['x'] ?></td>
                                    <td class="text-center"><?= $value['y'] ?></td>
                                    <td class="text-center">
                                        <form action="" method="get">
                                            <input type="hidden" name="act" value="pk">
                                            <input type="hidden" name="koef_a" value="<?= $_GET['koef_a'] ?>">
                                            <input type="hidden" name="koef_b" value="<?= $_GET['koef_b'] ?>">
                                            <input type="hidden" name="p" value="37">
                                            <input type="hidden" name="x" value="<?= $value['x'] ?>">
                                            <input type="hidden" name="y" value="<?= $value['y'] ?>">
                                            <button type="submit" class="btn btn-xs btn-primary">
                                                <i class="glyphicon glyphicon-check"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                        </table>
                    </div>
                    <?php } ?>
                    <?php
                if ((isset($_GET['act']) && $_GET['act'] == 'pk')
                    && (isset($_GET['p']) && isset($_GET['x']) && isset($_GET['y']) && isset($_GET['koef_a']))
                    && (!empty($_GET['p']) && !empty($_GET['x']) && !empty($_GET['y']) && !empty($_GET['koef_a']))) {

                    $representasi = representasiTitikKurva(
                        $_GET['p'],
                        $_GET['x'],
                        $_GET['y'],
                        $_GET['koef_a']
                    );

                    $titikKurvaDanSymbol = json_decode(json_encode($representasi['data']));
                    ?>
                    <script>
                        console.log( < ? = json_encode($representasi) ? > );

                    </script>
                    <div class="col-md-4" id="respon-tks" style="height: 350px;overflow-y: scroll">

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">P</th>
                                    <th class="text-center">Titik Kurva</th>
                                    <th class="text-center">Pilih</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            foreach ($titikKurvaDanSymbol as $row => $symbol) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= $symbol->P ?></td>
                                    <td class="text-center"><?= "({$symbol->x} , {$symbol->y})" ?></td>
                                    <td class="text-center">
                                        <form action="" method="post">
                                            <input type="hidden" name="act" value="pk">
                                            <input type="hidden" name="koef_a" value="<?= $_GET['koef_a'] ?>">
                                            <input type="hidden" name="koef_b" value="<?= $_GET['koef_b'] ?>">
                                            <input type="hidden" name="p" value="37">
                                            <input type="hidden" name="x" value="<?= $_GET['x'] ?>">
                                            <input type="hidden" name="y" value="<?= $_GET['y'] ?>">
                                            <input type="hidden" name="q[x]" value="<?= $symbol->x ?>">
                                            <input type="hidden" name="q[y]" value="<?= $symbol->y ?>">
                                            <input type="hidden" name="d"
                                                value="<?= str_replace('P', '', $symbol->P) ?>">
                                            <button type="submit" class="btn btn-xs btn-primary">
                                                <i class="glyphicon glyphicon-check"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="box-footer">

            </div>
        </div>
        <!-- /.box -->

    </section>

</div>
@endsection
