<?= $this->include('layout/sweetalert') ?>
<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary ">
                <h3 class="card-title">kegiatan</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body p-0 p-3">
                <div class="col-12 text-end">
                    <?php if (isset($backup)) : ?>
                        <button onclick="konfirmasiClear('clearKegiatan/backupKegiatan')" class="btn btn-danger fw-bold me-2 mb-3">Bersihkan Semua Data</button>
                    <?php else : ?>
                        <?php if (session()->get('masterkegiatan') or session()->get('level') == 'admin') : ?>
                            <button id="tambah" class="me-2 mb-2 btn btn bg-gradient-success ">Tambah kegiatan</button>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable" width="100%" cellspacing="0">
                        <thead class="bg-dark">
                            <tr>
                                <th class="text-center">Kegiatan</th>
                                <th>Ditujukan</th>
                                <th>Waktu</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = 1;
                            $ids = 1;
                            ?>
                            <?php foreach ($kegiatan as $data) : ?>
                                <tr>
                                    <td class="p-3" style="min-width:150px;"><?= $data['kegiatan'] ?></td>
                                    <td class="p-3"><?= $data['ditujukan'] ?></td>
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
                                    <td class="p-3" style="min-width:150px;"><?= $waktu ?></td>
                                    <td class="p-3" style="min-width: 250px;">
                                        <?php if (isset($backup)) : ?>
                                            <button onclick="konfirmasiRestore('restoreKegiatan/<?= $data['id_kegiatan']; ?>,backupKegiatan')" class="btn btn-success fw-bold text-white me-2">Restore Data</button>
                                            <button onclick="konfirmasiPermanent('deleteKegiatan/<?= $data['id_kegiatan']; ?>/backupKegiatan')" class="btn btn-danger fw-bold me-2">Hapus</button>
                                        <?php else : ?>
                                            <button id="view<?= $id++; ?>" data-ids="<?= $data['id_kegiatan']; ?>" class="btn btn-info fw-bold text-white me-2">Lihat</button>
                                            <?php if (session()->get('masterkegiatan') or session()->get('level') == 'admin') : ?>
                                                <button id="edit<?= $ids++; ?>" data-id="<?= $data['id_kegiatan']; ?>" class="btn btn-warning fw-bold text-white me-2">Edit</button>
                                                <button onclick="konfirmasiDel('delKegiatan/<?= $data['id_kegiatan']; ?>,kegiatan')" class="btn btn-danger fw-bold me-2">Hapus</button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>




            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.row -->
<script>
    $(document).ready(() => {
        let load = $("#load");
        let title = $("#hpage");
        let title2 = $("#hpage2");
        let list = $("#listpage");

        load.hide();

        function getData() {
            $.ajax({
                url: `<?= base_url() ?>/kegiatan`,
                dataType: 'html',
                type: "GET",
                beforeSend: function() {
                    load.show();
                },
                success: (respond) => {
                    $('#root').html(`${respond}`);
                },
            });
        }

        function hapus(key) {
            $.ajax({
                url: `<?= base_url() ?>/kegiatan/${key}`,
                dataType: 'json',
                type: "DELETE",
                beforeSend: function() {
                    load.show();
                },
                success: (respond) => {
                    getData();
                    dataHapus();
                },
            });
        }


        $('#tambah').click(() => {
            $.ajax({
                url: `<?= base_url() ?>/addKegiatan`,
                dataType: 'html',
                type: "GET",
                beforeSend: function() {
                    load.show();
                },
                success: (respond) => {
                    $('#root').html(`${respond}`);
                    list.html("add");
                },
            });
        })

        for (let i = 1; i <= <?= count($kegiatan) ?>; i++) {
            $(`#edit${i}`).click(function() {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: `<?= base_url() ?>/kegiatanEdit/${id}`,
                    dataType: 'html',
                    type: "GET",
                    beforeSend: function() {
                        load.show();
                    },
                    success: (respond) => {
                        $('#root').html(`${respond}`);
                        list.html("edit");
                    },
                });
            });
            $(`#view${i}`).click(function() {
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
                    },
                });
            });
        }


    })
</script>
<?= $this->include('layout/datatable') ?>