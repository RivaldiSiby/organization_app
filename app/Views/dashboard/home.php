<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
    <!-- /.col -->
    <?php $transisi = []; ?>
    <?php
    // memasukan array transisi

    for ($i = 1; $i <= 5; $i++) {
        if (session()->get("slide$i" . 'app') != "") {
            array_push($transisi, session()->get("slide$i" . 'app'));
        }
    }

    ?>
    <?php if (session()->get('level') == 'admin') : ?>
        <div class="col-<?= count($transisi) > 0 ? 'md-12' : 'md-6' ?>">
            <div class="info-box mb-3 shadow" style="border-right:20px solid #007BFF ;">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-shield"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Moderator</span>
                    <span class="info-box-number"><?= count($moderator); ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    <?php endif; ?>
    <!-- /.col -->
    <!-- /.col -->
    <?php if (session()->get('level') == 'admin' or session()->get('jabatan') != 'Member') : ?>
        <div class="col-<?= count($transisi) > 0 ? 'md-12' : 'md-6' ?>">
            <div class="info-box mb-3 shadow" style="border-right:20px solid #007BFF ;">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-th"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Bidang Organisasi</span>
                    <span class="info-box-number"><?= count($bidang); ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    <?php endif; ?>
    <!-- /.col -->
    <?php if (session()->get('level') == 'admin' or session()->get('masterprogram')) : ?>
        <div class="col-<?= count($transisi) > 0 ? 'md-12' : 'md-6' ?>">
            <div class="info-box mb-3 shadow" style="border-right:20px solid #007BFF ;">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-ellipsis-h"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Program Kerja</span>
                    <span class="info-box-number"><?= count($program); ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    <?php endif; ?>
    <!-- /.col -->
    <?php if (count($transisi) > 0) : ?>
        <div class="col-md-8 mb-3">
            <section class="slider bg-dark rounded shadow-sm mt-2">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <?php for ($i = 1; $i < count($transisi); $i++) : ?>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $i; ?>" aria-label="Slide <?= $i + 1; ?>"></button>
                        <?php endfor; ?>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item text-center active">
                            <img src="<?= base_url('/data/organisasi/slide/' . session()->get('slide1app')) ?>" class="d-block w-100 rounded imgslide" alt="...">

                        </div>
                        <?php for ($i = 1; $i < count($transisi); $i++) : ?>
                            <div class="carousel-item text-center">
                                <img src="<?= base_url('/data/organisasi/slide/' . $transisi[$i]) ?>" class="d-block w-100 rounded imgslide" alt="...">

                            </div>
                        <?php endfor; ?>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </section>
        </div>
    <?php endif; ?>

    <div class="col-<?= count($transisi) > 0 ? 'md-4' : 'md-6' ?>">
        <div class="info-box mb-3 shadow" style="border-right:20px solid #007BFF ;">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-newspaper"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Postingan</span>
                <span class="info-box-number"><?= count($postingan); ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        <div class="info-box mb-3 shadow" style="border-right:20px solid #007BFF ;">
            <span class="info-box-icon bg-primary elevation-1"> <i class="fas fa-columns"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Kegiatan</span>
                <span class="info-box-number"><?= count($kegiatan); ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        <div class="info-box mb-3 shadow" style="border-right:20px solid #007BFF ;">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-copy"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Laporan Keuangan</span>
                <span class="info-box-number"><?= count($keuangan); ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <div class="info-box mb-3 shadow" style="border-right:20px solid #007BFF ;">
            <span class="info-box-icon bg-primary elevation-1"><i class="far fa-envelope"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Surat</span>
                <span class="info-box-number"><?= count($surat); ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        <div class="info-box mb-3 shadow" style="border-right:20px solid #007BFF ;">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Member</span>
                <span class="info-box-number"><?= count($member); ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>


</div>
<?php if (session()->get('level') == 'admin') : ?>
    <div class="row mt-4 mb-3">
        <!-- Backup Data-->
        <h3>Backup Data</h3>
        <hr>
        <!-- /.col -->
        <div class="col-md-6">
            <div class="info-box mb-3 shadow" style="border-right:20px solid #343A40 ;">
                <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Member Backup</span>
                    <span class="info-box-number"><?= count($memberbackup); ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-md-6">
            <div class="info-box mb-3 shadow" style="border-right:20px solid #343A40 ;">
                <span class="info-box-icon bg-dark elevation-1"><i class="far fa-envelope"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Surat Backup</span>
                    <span class="info-box-number"><?= count($suratbackup); ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-md-6">
            <div class="info-box mb-3 shadow" style="border-right:20px solid #343A40 ;">
                <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-copy"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Laporan Keuangan Backup</span>
                    <span class="info-box-number"><?= count($keuanganbackup); ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-md-6">
            <div class="info-box mb-3 shadow" style="border-right:20px solid #343A40 ;">
                <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-newspaper"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Postingan Backup</span>
                    <span class="info-box-number"><?= count($postinganbackup); ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
            <div class="info-box mb-3 shadow" style="border-right:20px solid #343A40 ;">
                <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-columns"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Kegiatan Backup</span>
                    <span class="info-box-number"><?= count($kegiatanbackup); ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- Backup Data-->
    </div>
<?php endif; ?>


<hr>
<?php if (count($kegiatan) > 0) : ?>
    <div class="row p-2 d-flex bg-primary rounded">


        <div class="col-12">
            <h4 class="fw-bold  text-center pb-3"><span style="border-bottom:solid 3px #007BFF">Kegiatan Yang Akan Datang / Sementara Berlangsung</span></h4>
        </div>
        <?php $isi = false ?>
        <?php if (session()->get('jabatan') == 'Member') : ?>
            <?php $id = 1; ?>
            <?php foreach ($kegiatan as $data) : ?>
                <?php if ($data['ditujukan'] == 'publik' or $data['ditujukan'] == 'member') : ?>

                    <?php if ($time->isBefore($data['mulai_kegiatan'])) : ?>
                        <?php $isi = true ?>
                        <div class="col-md-4 border border-2 border-primary bg-white p-2 pt-3 pb-3 mb-3 rounded">

                            <div class="row">

                                <div class="col-md-12 text-center">
                                    <img style="min-height:200px;max-height:200px;" class="rounded shadow-sm border" src="<?= base_url('/data/kegiatan/' . $data['gambar']) ?>" alt="" width="90%">
                                </div>
                            </div>

                            <a href="#">
                                <h4 id="view<?= $id++; ?>" data-id="<?= $data['id_kegiatan']; ?>" class="fw-bold text-primary pt-2"><?= $data['kegiatan']; ?></h4>
                            </a>
                            <div class="col-12 ">

                                <p><span class="fw-bold bg-primary p-2 text-white rounded shadow"> Belum dimulai</span></p>

                                <?php
                                $time1 = explode('T', $data['mulai_kegiatan']);
                                $time2 = explode('T', $data['selesai_kegiatan']);

                                if ($time1[0] == $time2[0]) {
                                    $waktu = explode('-', $time1[0]);
                                    $waktu = $waktu[2] . '-' . $waktu[1] . '-' . $waktu[0] . ' | ' . $time1[1] . '<span class="text-primary fw-bold"> sd </span>' . $time2[1];
                                } else {
                                    $waktu1 = explode('-', $time1[0]);
                                    $waktu2 = explode('-', $time2[0]);

                                    $waktu = $waktu1[2] . '-' . $waktu1[1] . '-' . $waktu1[0] . ' | ' . $time1[1] . '<span class="text-primary fw-bold"> sd </span>' . $waktu2[2] . '-' . $waktu2[1] . '-' . $waktu2[0] . ' | ' . $time2[1];
                                }

                                ?>
                                <p> <i class="far fa-calendar-alt"></i> <?= $waktu; ?></p>
                            </div>
                        </div>

                    <?php elseif ($time->isAfter($data['mulai_kegiatan'])  and $time->isBefore($data['selesai_kegiatan'])) :  ?>
                        <?php $isi = true ?>
                        <div class="col-md-4 border border-2 border-primary bg-white p-2 pt-3 pb-3 mb-3 rounded">

                            <div class="row">

                                <div class="col-md-12 text-center">
                                    <img style="min-height:200px;max-height:200px;" class="rounded shadow-sm border" src="<?= base_url('/data/kegiatan/' . $data['gambar']) ?>" alt="" width="90%">
                                </div>
                            </div>

                            <a href="#">
                                <h4 id="view<?= $id++; ?>" data-id="<?= $data['id_kegiatan']; ?>" class="fw-bold text-primary pt-2"><?= $data['kegiatan']; ?></h4>
                            </a>
                            <div class="col-12 ">

                                <p><span class="fw-bold bg-success p-2 text-white rounded shadow"> Telah dimulai</span></p>

                                <?php
                                $time1 = explode('T', $data['mulai_kegiatan']);
                                $time2 = explode('T', $data['selesai_kegiatan']);

                                if ($time1[0] == $time2[0]) {
                                    $waktu = explode('-', $time1[0]);
                                    $waktu = $waktu[2] . '-' . $waktu[1] . '-' . $waktu[0] . ' | ' . $time1[1] . '<span class="text-primary fw-bold"> sd </span>' . $time2[1];
                                } else {
                                    $waktu1 = explode('-', $time1[0]);
                                    $waktu2 = explode('-', $time2[0]);

                                    $waktu = $waktu1[2] . '-' . $waktu1[1] . '-' . $waktu1[0] . ' | ' . $time1[1] . '<span class="text-primary fw-bold"> sd </span>' . $waktu2[2] . '-' . $waktu2[1] . '-' . $waktu2[0] . ' | ' . $time2[1];
                                }

                                ?>
                                <p> <i class="far fa-calendar-alt"></i> <?= $waktu; ?></p>
                            </div>
                        </div>

                    <?php endif; ?>

                <?php endif; ?>

            <?php endforeach;; ?>
        <?php else : ?>
            <?php foreach ($kegiatan as $data) : ?>
                <?php if ($data['ditujukan'] == 'publik' or $data['ditujukan'] == 'member' or $data['ditujukan'] == 'private') : ?>
                    <?php if ($time->isBefore($data['mulai_kegiatan'])) : ?>
                        <?php $id = 1; ?>
                        <?php $isi = true ?>
                        <div class="col-md-4 border border-2 border-primary bg-white p-2 pt-3 pb-3 mb-3 rounded">

                            <div class="row">

                                <div class="col-md-12 text-center">
                                    <img style="min-height:200px;max-height:200px;" class="rounded shadow-sm border" src="<?= base_url('/data/kegiatan/' . $data['gambar']) ?>" alt="" width="90%">
                                </div>
                            </div>

                            <a href="#">
                                <h4 id="view<?= $id++; ?>" data-id="<?= $data['id_kegiatan']; ?>" class="fw-bold text-primary pt-2"><?= $data['kegiatan']; ?></h4>
                            </a>
                            <div class="col-12 ">

                                <p><span class="fw-bold bg-primary p-2 text-white rounded shadow"> Belum dimulai</span></p>

                                <?php
                                $time1 = explode('T', $data['mulai_kegiatan']);
                                $time2 = explode('T', $data['selesai_kegiatan']);

                                if ($time1[0] == $time2[0]) {
                                    $waktu = explode('-', $time1[0]);
                                    $waktu = $waktu[2] . '-' . $waktu[1] . '-' . $waktu[0] . ' | ' . $time1[1] . '<span class="text-primary fw-bold"> sd </span>' . $time2[1];
                                } else {
                                    $waktu1 = explode('-', $time1[0]);
                                    $waktu2 = explode('-', $time2[0]);

                                    $waktu = $waktu1[2] . '-' . $waktu1[1] . '-' . $waktu1[0] . ' | ' . $time1[1] . '<span class="text-primary fw-bold"> sd </span>' . $waktu2[2] . '-' . $waktu2[1] . '-' . $waktu2[0] . ' | ' . $time2[1];
                                }

                                ?>
                                <p> <i class="far fa-calendar-alt"></i> <?= $waktu; ?></p>
                            </div>
                        </div>

                    <?php elseif ($time->isAfter($data['mulai_kegiatan'])  and $time->isBefore($data['selesai_kegiatan'])) : ?>
                        <?php $isi = true ?>
                        <div class="col-md-4 border border-2 border-primary bg-white p-2 pt-3 pb-3 mb-3 rounded">

                            <div class="row">

                                <div class="col-md-12 text-center">
                                    <img style="min-height:200px;max-height:200px;" class="rounded shadow-sm border" src="<?= base_url('/data/kegiatan/' . $data['gambar']) ?>" alt="" width="90%">
                                </div>
                            </div>

                            <a href="#">
                                <h4 id="view<?= $id++; ?>" data-id="<?= $data['id_kegiatan']; ?>" class="fw-bold text-primary pt-2"><?= $data['kegiatan']; ?></h4>
                            </a>
                            <div class="col-12 ">

                                <p><span class="fw-bold bg-success p-2 text-white rounded shadow"> Telah dimulai</span></p>

                                <?php
                                $time1 = explode('T', $data['mulai_kegiatan']);
                                $time2 = explode('T', $data['selesai_kegiatan']);

                                if ($time1[0] == $time2[0]) {
                                    $waktu = explode('-', $time1[0]);
                                    $waktu = $waktu[2] . '-' . $waktu[1] . '-' . $waktu[0] . ' | ' . $time1[1] . '<span class="text-primary fw-bold"> sd </span>' . $time2[1];
                                } else {
                                    $waktu1 = explode('-', $time1[0]);
                                    $waktu2 = explode('-', $time2[0]);

                                    $waktu = $waktu1[2] . '-' . $waktu1[1] . '-' . $waktu1[0] . ' | ' . $time1[1] . '<span class="text-primary fw-bold"> sd </span>' . $waktu2[2] . '-' . $waktu2[1] . '-' . $waktu2[0] . ' | ' . $time2[1];
                                }

                                ?>
                                <p> <i class="far fa-calendar-alt"></i> <?= $waktu; ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

            <?php endforeach;; ?>
        <?php endif; ?>
        <?php if ($isi == false) : ?>
            <p class="text-center fw-bold text-white p-3"> <i class="nav-icon fas fa-columns"></i> Belum ada kegiatan yang tersedia</p>
        <?php endif; ?>
    </div>

<?php endif; ?>
<div class="row p-2 d-flex bg-white mt-3">
    <?php $id = 1; ?>
    <?php if (count($postingan) > 0) : ?>
        <div class="col-12">
            <h2 class="fw-bold  text-center"><span style="border-bottom:solid 3px #007BFF">Postingan Terbaru</span></h2>
        </div>
    <?php endif; ?>
    <?php foreach ($postingan as $data) : ?>

        <div class="col-md-4 bg-white p-2 pt-3 pb-3 mb-3 ">

            <div class="row">

                <div class="col-md-12 text-center">
                    <img style="min-height:200px;max-height:200px;" class="rounded shadow-sm border" src="<?= base_url('/data/postingan/' . $data['file']) ?>" alt="" width="90%">
                </div>
            </div>

            <a href="#">
                <h4 id="views<?= $id++; ?>" data-ids="<?= $data['id_postingan']; ?>" class="fw-bold text-primary pt-2"><?= $data['judul_postingan']; ?></h4>
            </a>
            <div class="col-12 d-flex justify-content-between">
                <?php
                $time = explode(' ', $data['created_at']);
                $date = explode('-', $time[0]);
                ?>
                <small class="fw-bold"><span class="description text-secondary">Dibuat pada - <?= $date[2] . '-' . $date[1] . '-' . $date[0] ?></span></small>
                <small class="fw-bold"><span class="description text-secondary"><?= $time[1] ?></span></small>
            </div>
        </div>
    <?php endforeach;; ?>
</div>

<div class="row p-2 d-flex mt-3 bg-white">
    <?php if (count($surat) > 0) : ?>
        <div class="col-12">
            <h2 class="fw-bold  text-center"><span style="border-bottom:solid 3px #007BFF">Surat Terbaru</span></h2>
        </div>
    <?php endif; ?>
    <?php if (session()->get('jabatan') == 'Member') : ?>
        <?php foreach ($surat as $data) : ?>
            <?php if ($data['publikasi'] == 'yes') : ?>
                <div class="col-md-4 bg-white p-2 pt-3 pb-3 mb-3 rounded ">
                    <p class="text-secondary fw-bold">Nomor <?= $data['nomor_surat'] ?></p>
                    <div class="row">

                        <div class="col-12 text-center">
                            <?php $files = explode('.', $data['file']) ?>
                            <?php if ($files[1] == 'pdf') : ?>
                                <a style="width:90%;min-height:150px;font-size:50px" href="<?= base_url('/data/surat/' . $data['file']) ?>" class="btn btn-outline-danger fw-bold p-5">PDF</a>
                            <?php elseif ($files[1] == 'xls' or $files[1] == 'xlsx') : ?>
                                <a style="width:90%;min-height:150px;font-size:50px" href="<?= base_url('/data/surat/' . $data['file']) ?>" class="btn btn-outline-success fw-bold p-5">EXCEL</a>
                            <?php elseif ($files[1] == 'doc' or $files[1] == 'docx') : ?>
                                <a style="width:90%;min-height:150px;font-size:50px" href="<?= base_url('/data/surat/' . $data['file']) ?>" class="btn btn-outline-primary fw-bold p-5">WORD</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <h4 class="fw-bold text-dark pt-2"><?= $data['judul_surat']; ?></h4>
                    <div class="col-12 d-flex justify-content-between">
                        <?php
                        $time = explode(' ', $data['created_at']);
                        $date = explode('-', $time[0]);
                        ?>
                        <small class="fw-bold"><span class="description text-secondary">Dibuat pada - <?= $date[2] . '-' . $date[1] . '-' . $date[0] ?></span></small>
                        <small class="fw-bold"><span class="description text-secondary"><?= $time[1] ?></span></small>
                    </div>


                </div>
            <?php endif; ?>
        <?php endforeach;; ?>
    <?php else : ?>
        <?php foreach ($surat as $data) : ?>
            <div class="col-md-4 bg-white p-2 pt-3 pb-3 mb-3 rounded ">
                <p class="text-secondary fw-bold">Nomor <?= $data['nomor_surat'] ?></p>
                <div class="row">

                    <div class="col-12 text-center">
                        <?php $files = explode('.', $data['file']) ?>
                        <?php if ($files[1] == 'pdf') : ?>
                            <a style="width:90%;min-height:150px;font-size:50px" href="<?= base_url('/data/surat/' . $data['file']) ?>" class="btn btn-outline-danger fw-bold p-5">PDF</a>
                        <?php elseif ($files[1] == 'xls' or $files[1] == 'xlsx') : ?>
                            <a style="width:90%;min-height:150px;font-size:50px" href="<?= base_url('/data/surat/' . $data['file']) ?>" class="btn btn-outline-success fw-bold p-5">EXCEL</a>
                        <?php elseif ($files[1] == 'doc' or $files[1] == 'docx') : ?>
                            <a style="width:90%;min-height:150px;font-size:50px" href="<?= base_url('/data/surat/' . $data['file']) ?>" class="btn btn-outline-primary fw-bold p-5">WORD</a>
                        <?php endif; ?>
                    </div>
                </div>
                <h4 class="fw-bold text-dark pt-2"><?= $data['judul_surat']; ?></h4>
                <div class="col-12 d-flex justify-content-between">
                    <?php
                    $time = explode(' ', $data['created_at']);
                    $date = explode('-', $time[0]);
                    ?>
                    <small class="fw-bold"><span class="description text-secondary">Dibuat pada - <?= $date[2] . '-' . $date[1] . '-' . $date[0] ?></span></small>
                    <small class="fw-bold"><span class="description text-secondary"><?= $time[1] ?></span></small>
                </div>


            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<div class="row p-2 d-flex bg-white mt-3">

    <?php if (count($keuangan) > 0) : ?>
        <div class="col-12">
            <h2 class="fw-bold  text-center"><span style="border-bottom:solid 3px #007BFF">Laporan Keuangan Terbaru</span></h2>
        </div>
    <?php endif; ?>
    <?php if (session()->get('jabatan') == 'Member') : ?>

        <?php foreach ($keuangan as $data) : ?>
            <?php if ($data['publikasi'] == 'yes') : ?>
                <div class="col-md-4 bg-white p-2 pt-3 pb-3 mb-3 rounded ">
                    <p class="text-secondary fw-bold">Nomor <?= $data['nomor_laporan'] ?></p>
                    <div class="row">

                        <div class="col-12 text-center">
                            <?php $files = explode('.', $data['file']) ?>
                            <?php if ($files[1] == 'pdf') : ?>
                                <a style="width:90%;min-height:150px;font-size:50px" href="<?= base_url('/data/surat/' . $data['file']) ?>" class="btn btn-outline-danger fw-bold p-5">PDF</a>
                            <?php elseif ($files[1] == 'xls' or $files[1] == 'xlsx') : ?>
                                <a style="width:90%;min-height:150px;font-size:50px" href="<?= base_url('/data/surat/' . $data['file']) ?>" class="btn btn-outline-success fw-bold p-5">EXCEL</a>
                            <?php elseif ($files[1] == 'doc' or $files[1] == 'docx') : ?>
                                <a style="width:90%;min-height:150px;font-size:50px" href="<?= base_url('/data/surat/' . $data['file']) ?>" class="btn btn-outline-primary fw-bold p-5">WORD</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <h4 class="fw-bold text-info pt-2"><?= $data['judul_laporan']; ?></h4>
                    <div class="col-12 d-flex justify-content-between">
                        <?php
                        $time = explode(' ', $data['created_at']);
                        $date = explode('-', $time[0]);
                        ?>
                        <small class="fw-bold"><span class="description text-secondary">Dibuat pada - <?= $date[2] . '-' . $date[1] . '-' . $date[0] ?></span></small>
                        <small class="fw-bold"><span class="description text-secondary"><?= $time[1] ?></span></small>
                    </div>


                </div>

            <?php endif; ?>

        <?php endforeach; ?>
    <?php else : ?>

        <?php foreach ($keuangan as $data) : ?>
            <div class="col-md-4 bg-white p-2 pt-3 pb-3 mb-3 rounded ">
                <p class="text-secondary fw-bold">Nomor <?= $data['nomor_laporan'] ?></p>
                <div class="row">

                    <div class="col-12 text-center">
                        <?php $files = explode('.', $data['file']) ?>
                        <?php if ($files[1] == 'pdf') : ?>
                            <a style="width:90%;min-height:150px;font-size:50px" href="<?= base_url('/data/surat/' . $data['file']) ?>" class="btn btn-outline-danger fw-bold p-5">PDF</a>
                        <?php elseif ($files[1] == 'xls' or $files[1] == 'xlsx') : ?>
                            <a style="width:90%;min-height:150px;font-size:50px" href="<?= base_url('/data/surat/' . $data['file']) ?>" class="btn btn-outline-success fw-bold p-5">EXCEL</a>
                        <?php elseif ($files[1] == 'doc' or $files[1] == 'docx') : ?>
                            <a style="width:90%;min-height:150px;font-size:50px" href="<?= base_url('/data/surat/' . $data['file']) ?>" class="btn btn-outline-primary fw-bold p-5">WORD</a>
                        <?php endif; ?>
                    </div>
                </div>
                <h4 class="fw-bold text-info pt-2"><?= $data['judul_laporan']; ?></h4>
                <div class="col-12 d-flex justify-content-between">
                    <?php
                    $time = explode(' ', $data['created_at']);
                    $date = explode('-', $time[0]);
                    ?>
                    <small class="fw-bold"><span class="description text-secondary">Dibuat pada - <?= $date[2] . '-' . $date[1] . '-' . $date[0] ?></span></small>
                    <small class="fw-bold"><span class="description text-secondary"><?= $time[1] ?></span></small>
                </div>


            </div>
        <?php endforeach;; ?>
    <?php endif; ?>
</div>
<script>
    $(document).ready(() => {
        let title = $("#hpage");
        let title2 = $("#hpage2");
        let list = $("#listpage");
        let load = $("#load");
        load.hide();
        for (let i = 1; i <= <?= count($postingan) ?>; i++) {
            $(`#views${i}`).click(function() {
                let id = $(this).attr('data-ids');
                $.ajax({
                    url: `<?= base_url() ?>/postingan/${id}`,
                    dataType: 'html',
                    type: "GET",
                    beforeSend: function() {
                        load.show();
                    },
                    success: (respond) => {
                        $('#root').html(`${respond}`);
                        list.html("detail");
                        title.html("Postingan");
                        title2.html("Postingan");
                    },
                });
            });
        }
        for (let i = 1; i <= <?= count($kegiatan) ?>; i++) {
            $(`#view${i}`).click(function() {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: `<?= base_url() ?>/kegiatan/${id}`,
                    dataType: 'html',
                    type: "GET",
                    beforeSend: function() {
                        load.show();
                    },
                    success: (respond) => {
                        $('#root').html(`${respond}`);
                        list.html("detail");
                        title.html("Kegiatan");
                        title2.html("Kegiatan");
                    },
                });
            });
        }
    })
</script>