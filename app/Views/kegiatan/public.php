<div class="row p-2 d-flex bg-white m-2" style="min-height:30vh;">
    <div class=" col-12">
        <h2 class="fw-bold  text-center"><span style="border-bottom:solid 3px #007BFF">Kegiatan Organisasi</span></h2>
    </div>

    <?php if (session()->get('jabatan') == 'Member') : ?>
        <?php $id = 1 ?>
        <?php foreach ($kegiatan as $data) : ?>
            <?php if ($data['ditujukan'] == 'publik' or $data['ditujukan'] == 'member') : ?>
                <?php if ($time->isBefore($data['mulai_kegiatan'])) : ?>
                    <div class="col-md-4 border border-2 bg-white p-2 pt-3 pb-3 mb-3 rounded ">

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
                <?php elseif ($time->isAfter($data['selesai_kegiatan'])) : ?>
                    <div class="col-md-4 border border-2 bg-white p-2 pt-3 pb-3 mb-3 rounded">

                        <div class="row">

                            <div class="col-md-12 text-center">
                                <img style="min-height:200px;max-height:200px;" class="rounded shadow-sm border" src="<?= base_url('/data/kegiatan/' . $data['gambar']) ?>" alt="" width="90%">
                            </div>
                        </div>

                        <a href="#">
                            <h4 id="view<?= $id++; ?>" data-id="<?= $data['id_kegiatan']; ?>" class="fw-bold text-primary pt-2"><?= $data['kegiatan']; ?></h4>
                        </a>
                        <div class="col-12 ">

                            <p><span class="fw-bold bg-danger p-2 text-white rounded shadow"> Telah Selesai</span></p>

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
                <?php elseif ($time->isAfter($data['mulai_kegiatan'])) : ?>
                    <div class="col-md-4 border border-2 bg-white p-2 pt-3 pb-3 mb-3 rounded">

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
    <?php if (count($kegiatan) == 0) : ?>
        <p class="text-center fw-bold text-secondary p-3"> <i class="nav-icon fas fa-columns"></i> Belum ada kegiatan yang tersedia</p>
    <?php endif; ?>
</div>




<script>
    $(document).ready(() => {
        let title = $("#hpage");
        let title2 = $("#hpage2");
        let list = $("#listpage");
        let load = $("#load");
        load.hide();
        for (let i = 1; i <= <?= count($kegiatan) ?>; i++) {
            $(`#views${i}`).click(function() {
                let id = $(this).attr('data-ids');
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