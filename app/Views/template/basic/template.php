<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Gothic&family=Pacifico&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <!-- bootstrap 5 -->
    <link rel="stylesheet" href="<?= base_url('/template/plugins/fontawesome-free/css/all.min.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('/template/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/css/basic/main.css') ?>">
    <title id="tittle"><?= session()->get('nameapp') ?> | Home</title>
</head>


<body>
    <!-- head logo-->
    <!-- head logo-->
    <!-- sweatalert -->
    <?= $this->include('layout/sweetalert') ?>
    <!-- navbar -->
    <?php if (session()->get('level')) : ?>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-<?= session()->get('color') ?> shadow">
            <div class="container-fluid ">
                <div class="row w-100">
                    <div class="col-12 d-flex justify-content-end">
                        <small class="text-white fw-bold text-end p-2 pt-3">Hi , <?= session()->get('nama') ?></small>
                        <button onclick="konfirmasiLogout('logout')" class="btn btn-danger m-1">Logout</button>
                    </div>
                </div>
            </div>
        </nav>
    <?php endif; ?>
    <nav <?= session()->get('level') ? "style='margin-top: 60px;'" : '' ?> class="navbar fixed-top navbar-expand-lg navbar-light bg-white shadow <?= session()->get('level') ? 'border-bottom border-' . session()->get('color') . ' border-2' : '' ?>">
        <div class="container-fluid">
            <div class="col-2 text-center">
                <img class="m-2" style="max-height: 60px;max-width:70px;" width="95%;" src="<?= base_url('/data/organisasi/logo/' . session()->get('logoapp')) ?>" alt="">
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto ">
                    <li class="nav-item me-2">
                        <a class="nav-link border-bottom border-2 border-<?= session()->get('color') ?> fw-bold text-secondary" aria-current="page" id="home" href="#"><i class="fas fa-home fa-fw"></i>Beranda</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link border-<?= session()->get('color') ?> fw-bold text-secondary" aria-current="page" id="post" href="#">Postingan</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link border-<?= session()->get('color') ?> fw-bold text-secondary" aria-current="page" id="program" href="#">Program Kerja</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link border-<?= session()->get('color') ?> fw-bold text-secondary" aria-current="page" id="sejarah" href="#">Sejarah</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link border-<?= session()->get('color') ?> fw-bold text-secondary" aria-current="page" id="struktur" href="#">Struktur Organisasi</a>
                    </li>

                    <li class="nav-item me-2">
                        <a class="nav-link border-<?= session()->get('color') ?> fw-bold text-secondary" aria-current="page" id="tentang" href="#">Tentang Kami</a>
                    </li>
                    <?php if (session()->get('level')) : ?>

                        <li class="nav-item me-2">
                            <a class="nav-link fw-bold text-secondary  rounded pe-3 ps-3 btn btn-<?= session()->get('color') ?> text-white" aria-current="page" href="<?= base_url('/dashboard') ?>"> <i class="fas fa-home fa-fw"></i>Dashboard</a>
                        </li>

                    <?php else : ?>
                        <li class="nav-item me-2">
                            <a class="nav-link fw-bold text-secondary rounded pe-3 ps-3 btn btn-<?= session()->get('color') ?> text-white" aria-current="page" href="<?= base_url('/login') ?>">Login</a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar -->
    <!-- jquery -->
    <script src="<?= base_url('/js/jquery.js') ?>"></script>
    <!-- jquery -->
    <div style=" <?= session()->get('level') ? 'margin-top:150px' : 'margin-top:100px' ?>">
        <div class="row">
            <input type="hidden" id="baseurl" value="<?= base_url() ?>">

            <div class="col-md-9" id="app">
                <?= $this->renderSection('homepage'); ?>
            </div>
            <div class="col-md-3  mt-5">
                <div class="row d-flex justify-content-center p-2">
                    <?php foreach ($member as $data) : ?>
                        <div class="col-md-10 rounded p-2 m-2 mb-3 shadow-sm border text-center">
                            <img class="imgside" style="max-height: 150px;border-radius:12px" src="<?= base_url('/data/member/img/' . $data[0]['foto']) ?>" alt="">
                            <small class="fw-bold text-secondary d-block"><?= $data[0]['nama']; ?></small>
                            <p class="fw-bold "><?= $data[0]['jabatan']; ?></p>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
    <section class="footer bg-dark">
        <div class="col text-end p-3 pb-0">
            <small class=" text-white">Copyright &copy 2022 <?= session()->get('nameapp') ?> </small>

        </div>
        <div class="col text-end p-3 pt-0">
            <small class="text-secondary">OrganizationApp V-1</small>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- jQuery -->

    <script src="<?= base_url('/template/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- ajax js -->
    <script src="<?= base_url('/js/home.js') ?>"></script>
</body>

</html>