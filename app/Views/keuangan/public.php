<div class="row p-2 d-flex bg-white " style="min-height:90vh;">
    <div class="col-12">
        <h2 class="fw-bold  text-center"><span style="border-bottom:solid 3px #007BFF">Keuangan</span></h2>
    </div>
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
    <?php endif; ?>
    <?php if (count($keuangan) == 0) : ?>
        <p class="text-center fw-bold text-secondary p-3"> <i class="nav-icon fas fa-copy"></i> Belum ada Laporan Keuangan yang tersedia</p>
    <?php endif; ?>
</div>