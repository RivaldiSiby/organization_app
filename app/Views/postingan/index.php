<?= $this->include('layout/sweetalert') ?>
<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary ">
                <h3 class="card-title">Postingan</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body p-0 p-3">
                <div class="col-12 text-end">
                    <?php if (isset($backup)) : ?>
                        <button onclick="konfirmasiClear('clearPostingan/backupPostingan')" class="btn btn-danger fw-bold me-2 mb-3">Bersihkan Semua Data</button>
                    <?php else : ?>
                        <?php if (session()->get('masterpostingan') or session()->get('level') == 'admin') : ?>
                            <button id="tambah" class="me-2 mb-2 btn btn bg-gradient-success ">Tambah Postingan</button>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable" width="100%" cellspacing="0">
                        <thead class="bg-dark">
                            <tr>
                                <th class="text-center">Judul Postingan</th>
                                <th>Ditujukan</th>
                                <th>Angkatan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = 1;
                            $ids = 1;
                            ?>
                            <?php foreach ($postingan as $data) : ?>
                                <tr>
                                    <td class="p-3" style="min-width:150px;"><?= $data['judul_postingan'] ?></td>
                                    <td class="p-3"><?= $data['ditujukan'] ?></td>
                                    <td class="p-3"><?= $data['angkatan'] ?></td>
                                    <td class="p-3" style="min-width: 250px;">
                                        <?php if (isset($backup)) : ?>
                                            <button onclick="konfirmasiRestore('restorePostingan/<?= $data['id_postingan']; ?>,backupPostingan')" class="btn btn-success fw-bold text-white me-2">Restore Data</button>
                                            <button onclick="konfirmasiPermanent('deletePostingan/<?= $data['id_postingan']; ?>/backupPostingan')" class="btn btn-danger fw-bold me-2">Hapus</button>
                                        <?php else : ?>
                                            <button id="view<?= $id++; ?>" data-ids="<?= $data['id_postingan']; ?>" class="btn btn-info fw-bold text-white me-2">Lihat</button>
                                            <?php if (session()->get('masterpostingan') or session()->get('level') == 'admin') : ?>
                                                <button id="edit<?= $ids++; ?>" data-id="<?= $data['id_postingan']; ?>" class="btn btn-warning fw-bold text-white me-2">Edit</button>
                                                <button onclick="konfirmasiDel('delPostingan/<?= $data['id_postingan']; ?>,postingan')" class="btn btn-danger fw-bold me-2">Hapus</button>
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
                url: `<?= base_url() ?>/postingan`,
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
                url: `<?= base_url() ?>/postingan/${key}`,
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
                url: `<?= base_url() ?>/addPostingan`,
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

        for (let i = 1; i <= <?= count($postingan) ?>; i++) {
            $(`#edit${i}`).click(function() {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: `<?= base_url() ?>/postinganEdit/${id}`,
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
                    url: `<?= base_url() ?>/postingan/${id}`,
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