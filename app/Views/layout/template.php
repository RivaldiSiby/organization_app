<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= session()->get('nameapp') ?> | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="shortcut icon" href="<?= base_url('/data/organisasi/icon/' . session()->get('iconapp')); ?>" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Gothic&family=Pacifico&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('/template/plugins/fontawesome-free/css/all.min.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('/template/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/template/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/css/font.css') ?>">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">


</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="<?= base_url('/') ?>" role="button">
                        <i class="fas fa-box"></i> Website
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-user"></i> Profile
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <p class="brand-link">
                <img src="<?= base_url('/data/organisasi/logo/' . session()->get('logoapp')) ?>" alt="App Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span style="font-weight:bold" class="brand-text font-weight-light fw-bold"><?= session()->get('nameapp') ?></span>
            </p>

            <!-- Sidebar -->
            <div class="sidebar bg-white">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-2 d-flex">
                    <div class="image">
                        <?php  ?>
                        <?php if (session()->get('profile') != '') : ?>
                            <img style="min-height:35px;" src="<?= (session()->get('level') == 'admin') ? base_url('/img/admin.png') : base_url('/data/member/img/' . session()->get('profile')) ?>" class="img-circle elevation-2" alt="User Image">
                        <?php else : ?>
                            <img style="min-height:35px;" src="<?= (session()->get('level') == 'admin') ? base_url('/img/admin.png') : base_url('/img/profile.png') ?>" class="img-circle elevation-2" alt="User Image">
                        <?php endif; ?>
                    </div>
                    <div class="info">
                        <div class="app pt-2">
                            <p class="d-block"><?= session()->get('nama') ?></p>
                        </div>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="#" id="dashboard" class="nav-link active">
                                <i class="nav-icon fas fa-home fa-fw"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <?php if (session()->get('level') == 'admin') : ?>
                            <li class="nav-item">
                                <a href="#" id="moderator" class="nav-link">
                                    <i class="nav-icon fas fa-user-shield fa-fw"></i>
                                    <p>
                                        Moderator
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (session()->get('level') == 'admin' || session()->get('masterbidang') == true) : ?>
                            <li class="nav-item">
                                <a href="#" id="bidang" class="nav-link">
                                    <i class="nav-icon fas fa-th fa-fw"></i>
                                    <p>
                                        Bidang Organisasi
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="#" id="program" class="nav-link">
                                <i class="nav-icon fas fa-ellipsis-h fa-fw"></i>
                                <p>
                                    Program Kerja
                                </p>
                            </a>
                        </li>
                        <?php if (session()->get('jabatan') == 'Member') : ?>
                            <li class="nav-item">
                                <a href="#" id="fitursurat" class="nav-link">
                                    <i class="nav-icon far fa-envelope"></i>
                                    <p>Surat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" id="fiturkeuangan" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>Laporan Keuangan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" id="fiturpostingan" class="nav-link">
                                    <i class="far fa-newspaper nav-icon"></i>
                                    <p>Postingan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" id="fiturkegiatan" class="nav-link">
                                    <i class="nav-icon fas fa-columns"></i>
                                    <p>Kegiatan</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (session()->get('level') == 'member' && session()->get('jabatan') != 'Member') : ?>

                            <li class="nav-item">
                                <a href="#" id="<?= (session()->get('mastermember')) ? 'mastermember' : 'fiturmember' ?>" class="nav-link ">
                                    <i class="far fa-user nav-icon"></i>
                                    <p>Member</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" id="<?= (session()->get('mastersurat')) ? 'mastersurat' : 'fitursurat' ?>" class="nav-link">
                                    <i class="nav-icon far fa-envelope"></i>
                                    <p>Surat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" id="<?= (session()->get('masterkeuangan')) ? 'masterkeuangan' : 'fiturkeuangan' ?>" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>Laporan Keuangan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" id="<?= (session()->get('masterpostingan')) ? 'masterpostingan' : 'fiturpostingan' ?>" class="nav-link">
                                    <i class="far fa-newspaper nav-icon"></i>
                                    <p>Postingan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" id="<?= (session()->get('masterkegiatan')) ? 'masterkegiatan' : 'fiturkegiatan' ?>" class="nav-link">
                                    <i class="nav-icon fas fa-columns"></i>
                                    <p>Kegiatan</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (session()->get('level') == 'admin') : ?>
                            <li class="nav-item menu-closed">
                                <a href="#" id="master" class="nav-link ">
                                    <i class="nav-icon fas fa-database"></i>
                                    <p>
                                        Master Data
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" id="mastermember" class="nav-link ">
                                            <i class="far fa-user nav-icon"></i>
                                            <p>Member</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" id="mastersurat" class="nav-link">
                                            <i class="nav-icon far fa-envelope"></i>
                                            <p>Surat</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" id="masterkeuangan" class="nav-link">
                                            <i class="nav-icon fas fa-copy"></i>
                                            <p>Laporan Keuangan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" id="masterpostingan" class="nav-link">
                                            <i class="far fa-newspaper nav-icon"></i>
                                            <p>Postingan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" id="masterkegiatan" class="nav-link">
                                            <i class="nav-icon fas fa-columns"></i>
                                            <p>Kegiatan</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item menu-closed">
                                <a href="#" id="backup" class="nav-link ">
                                    <i class="nav-icon fas fa-database"></i>
                                    <p>
                                        Backup Data
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" id="backupmember" class="nav-link ">
                                            <i class="far fa-user nav-icon"></i>
                                            <p>Member</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" id="backupsurat" class="nav-link">
                                            <i class="nav-icon far fa-envelope"></i>
                                            <p>Surat</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" id="backupkeuangan" class="nav-link">
                                            <i class="nav-icon fas fa-copy"></i>
                                            <p>Laporan Keuangan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" id="backuppostingan" class=" nav-link">
                                            <i class="far fa-newspaper nav-icon"></i>
                                            <p>Postingan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" id="backupkegiatan" class="nav-link">
                                            <i class="nav-icon fas fa-columns"></i>
                                            <p>Kegiatan</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="#" id="organisasi" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        Pengaturan Aplikasi
                                    </p>
                                </a>
                            </li>

                        <?php endif; ?>
                        <?php if (session()->get('jabatan') != 'Member') : ?>
                            <li class="nav-item">
                                <a href="#" id="log" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Log Aktifitas
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0" id="hpage">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <p href="#" id="hpage2">Dahsboard</p>
                                </li>
                                <li class="breadcrumb-item active" id="listpage">Home</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <input type="hidden" id="baseurl" value="<?= base_url() ?>">
                    <!-- sweetalert -->
                    <?= $this->include('layout/sweetalert'); ?>
                    <!-- ckeditor -->
                    <script src="<?= base_url('/template/ckeditor/build/ckeditor.js') ?>"></script>
                    <!-- ckeditor -->
                    <!-- jquery -->
                    <script src="<?= base_url('/js/jquery.js') ?>"></script>
                    <!-- jquery -->
                    <div id="root">
                        <?= $this->renderSection('dashboard') ?>
                    </div>

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-light shadow">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <div class="card card-primary card-outline">
                    <div class="card-header bg-primary box-profile">
                        <h4 class="fw-bold text-white text-center"><?= (session()->get('level') == 'admin') ? 'Admin' : 'Member' ?></h4>
                    </div>
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <?php if (session()->get('profile') != '') : ?>
                                <img class="profile-user-img img-fluid img-circle" style="max-height:150px;" src="<?= (session()->get('level') == 'admin') ? base_url('/img/admin.png') : base_url('/data/member/img/' . session()->get('profile')) ?>" alt="User profile picture">
                            <?php else : ?>
                                <img class="profile-user-img img-fluid img-circle" style="max-height:150px;" src="<?= (session()->get('level') == 'admin') ? base_url('/img/admin.png') : base_url('/img/profile.png') ?>" alt="User profile picture">
                            <?php endif; ?>
                        </div>
                        <h3 class="profile-username text-center">
                            <p><?= session()->get('nama') ?></p>
                        </h3>
                        <?php if (session()->get('level') == 'admin') : ?>
                            <p class="text-muted text-center fw-bold">Administrator</p>
                        <?php else : ?>
                            <p class="text-muted text-center fw-bold"><?= (session()->get('jabatan') == 'Member') ? 'Anggota' : session()->get('jabatan') ?></p>
                        <?php endif; ?>




                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer box-profile">
                        <?php if (session()->get('level') == 'member') : ?>
                            <input type="hidden" id="idusers" value="<?= session()->get('id') ?>">
                            <h4 id="profilemember" class="btn btn-outline-primary btn-block"><b>Profile</b></h4>
                        <?php endif; ?>
                        <h4 onclick="konfirmasiLogout('logout')" class=" btn btn-outline-primary btn-block"><b>Logout</b></h4>
                    </div>
                </div>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right text-primary fw-bold d-none d-sm-inline">
                Organization-App V-1
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2022 <?= session()->get('nameapp') ?></strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->

    <script src="<?= base_url('/template/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- ajax js -->
    <script src="<?= base_url('/js/main.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('/template/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('/template/dist/js/adminlte.min.js') ?>"></script>
    <!-- data table -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>



</body>

</html>