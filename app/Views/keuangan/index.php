<?= $this->include('layout/sweetalert') ?>
<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary ">
                <h3 class="card-title">Laporan Keuangan</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body p-0 p-3">
                <div class="col-12 text-end">
                    <div class="col-12 text-end p-2">
                        <?php if (isset($backup)) : ?>
                            <button onclick="konfirmasiClear('clearKeuangan/backupKeuangan')" class="btn btn-danger fw-bold me-2">Bersihkan Semua Data</button>
                        <?php else : ?>
                            <?php if (session()->get('masterkeuangan') or session()->get('level') == 'admin') : ?>
                                <button id="tambah" class="me-2 mb-2 btn btn bg-gradient-success ">Tambah Laporan Keuangan</button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable" width="100%" cellspacing="0">
                        <thead class="bg-dark">
                            <tr>
                                <th>Nomor Laporan</th>
                                <th class="text-center">Judul Laporan</th>
                                <th>Angkatan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = 1;
                            $ids = 1;
                            ?>
                            <?php foreach ($keuangan as $data) : ?>
                                <tr>
                                    <td class="p-3"><?= $data['nomor_laporan'] ?></td>
                                    <td class="p-3" style="min-width:150px;"><?= $data['judul_laporan'] ?></td>
                                    <td class="p-3"><?= $data['angkatan'] ?></td>
                                    <td class="p-3" style="min-width: 250px;">
                                        <?php if (isset($backup)) : ?>
                                            <button onclick="konfirmasiRestore('restoreKeuangan/<?= $data['id_laporan']; ?>,backupKeuangan')" class="btn btn-success fw-bold text-white me-2">Restore Data</button>
                                            <button onclick="konfirmasiPermanent('deleteKeuangan/<?= $data['id_laporan']; ?>/backupKeuangan')" class="btn btn-danger fw-bold me-2">Hapus</button>
                                        <?php else : ?>
                                            <button id="view<?= $id++; ?>" data-ids="<?= $data['id_laporan']; ?>" class="btn btn-info fw-bold text-white me-2">Lihat</button>
                                            <?php if (session()->get('masterkeuangan') or session()->get('level') == 'admin') : ?>
                                                <button id="edit<?= $ids++; ?>" data-id="<?= $data['id_laporan']; ?>" class="btn btn-warning fw-bold text-white me-2">Edit</button>
                                                <button onclick="konfirmasiDel('delKeuangan/<?= $data['id_laporan']; ?>,keuangan')" class="btn btn-danger fw-bold me-2">Hapus</button>
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


        $('#tambah').click(() => {
            $.ajax({
                url: `<?= base_url() ?>/addKeuangan`,
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

        for (let i = 1; i <= <?= count($keuangan) ?>; i++) {
            $(`#edit${i}`).click(function() {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: `<?= base_url() ?>/keuanganEdit/${id}`,
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
                    url: `<?= base_url() ?>/keuangan/${id}`,
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