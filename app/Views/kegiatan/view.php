<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header bg-primary text-end">
            </div>
            <!-- /.card-header -->

            <div class="card-body p-2">
                <h2 class="fw-bold"><?= $kegiatan['kegiatan'] ?></h2>
                <div class="row p-3">
                    <?php if ($kegiatan['gambar'] != '') : ?>
                        <div class="col-md-3 text-center mb-2 ">
                            <img class="rounded shadow-sm" style="min-height: 200px;max-height:200px;" src="<?= base_url('/data/kegiatan/' . $kegiatan['gambar']) ?>" width="100%" alt="">
                        </div>

                    <?php else : ?>
                        <div class="col-md-3 text-center mb-2 ">
                            <img class="rounded shadow-sm" style="min-height: 200px;max-height:200px;" src="<?= base_url('/data/organisasi/logo/' . session()->get('logoapp')) ?>" width="100%" alt="">
                        </div>
                    <?php endif; ?>

                    <div class="col-md-8">
                        <?= $kegiatan['pesan_kegiatan']; ?>
                        <br>
                        <?php if ($time == 'belum') : ?>
                            <p><span class="fw-bold bg-primary p-2 text-white rounded shadow"> Belum dimulai</span></p>
                        <?php elseif ($time == 'dimulai') : ?>
                            <p><span class="fw-bold bg-success p-2 text-white rounded shadow"> Telah dimulai</span></p>
                        <?php elseif ($time == 'selesai') : ?>
                            <p><span class="fw-bold bg-danger p-2 text-white rounded shadow"> Telah Selesai</span></p>
                        <?php endif; ?>
                        <?php
                        $time1 = explode('T', $kegiatan['mulai_kegiatan']);
                        $time2 = explode('T', $kegiatan['selesai_kegiatan']);

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


            </div>


            <?php if (session()->get('level' == 'admin')) : ?>
                <div class="col-12 mt-1 text-end">
                    <h4 id="batal" class="btn btn-primary ms-2 mt-2 ">Kembali</h4>
                </div>
            <?php endif; ?>

        </div>

    </div>
</div>
<!-- /.card-body -->


</div>
<!-- /.card -->
</div>
</div>
<script>
    $(document).ready(() => {
        let load = $("#load");
        load.hide();
        let list = $("#listpage");
        // tarik data
        function getData() {
            $.ajax({
                url: `<?= (session()->get('masterkegiatan')) ? base_url('/kegiatan') : base_url('/apiKegiatan') ?>`,
                dataType: 'html',
                type: "GET",
                beforeSend: function() {
                    load.show();
                },
                success: (respond) => {
                    $('#root').html(`${respond}`);
                    list.html('view')
                },
            });
        }
        // Batal 
        $('#batal').click(() => {
            getData();
        })




    })
</script>