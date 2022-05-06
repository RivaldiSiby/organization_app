<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= session()->get('nameapp') ?> | Login</title>
    <link rel="shortcut icon" href="<?= base_url('/data/organisasi/icon/' . session()->get('iconapp')); ?>" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('/template/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('/template/dist/css/adminlte.min.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .imgbg {
            background: url(<?= (session()->get('imgbg') == "") ? "https://unsplash.com/photos/hh2iGIu3rEU/download?force=true&w=1920" : base_url('/data/organisasi/background/' . session()->get('imgbg')) ?>);
        }
    </style>
</head>


<body class="hold-transition login-page imgbg">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline shadow bg-white">
            <div class="card-header text-center bg-white">
                <img src="<?= base_url('/data/organisasi/logo/' . session()->get('logoapp')) ?>" alt="" width="80%" height="200px">
            </div>
            <div class="card-body">
                <h3 class="login-box-msg fw-bold">Selamat Datang </h3>
                <p class="text-center fw-bold">Silahkan login disini</p>
                <form action="<?= base_url("/otentikasi"); ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="input-group mt-2">
                        <input type="text" name="nama" class="form-control <?= ($validation->hasError('nama')) ? 'border-danger' : '' ?><?= (session()->getFlashdata('failnama')) ? 'border-danger' : '' ?>" placeholder="Nama" value="<?= old('nama'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <p class="text-danger p-1 fw-bold text-center"><?= $validation->getError('nama'); ?><?= session()->getFlashdata('failnama') ?></p>
                    <div class="input-group mt-2">
                        <input type="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'border-danger' : '' ?><?= (session()->getFlashdata('failpass')) ? 'border-danger' : '' ?>" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <p class="text-danger p-1 fw-bold text-center"><?= $validation->getError('password'); ?><?= session()->getFlashdata('failpass') ?></p>

                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('/template/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('/template/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('/template/dist/js/adminlte.min.js') ?>"></script>
</body>

</html>