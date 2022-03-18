<?= $this->include('layout/sweetalert') ?>
<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary ">
                <h3 class="card-title">Member</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body p-0 p-3">
                <div class="col-12 text-end p-2">
                    <?php if (isset($backup)) : ?>
                        <button onclick="konfirmasiClear('clearMember/backupMember')" class="btn btn-danger fw-bold me-2">Bersihkan Semua Data</button>
                    <?php else : ?>
                        <?php if (session()->get('mastermember') or session()->get('level') == 'admin') : ?>
                            <button id="tambah" class="btn btn bg-gradient-success ">Tambah Member</button>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable" width="100%" cellspacing="0">
                        <thead class="bg-dark">
                            <tr>
                                <th class="text-center">Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Nomor KTA</th>
                                <th>Jabatan</th>
                                <th>Angkatan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = 1;
                            $ids = 1;
                            $idd = 1;
                            ?>
                            <?php foreach ($member as $data) : ?>
                                <tr <?= ($data['nama'] == session()->get('nama')) ? "class='bg-dark'" : '' ?>>
                                    <td class="p-3" style="min-width:150px;"><?= $data['nama'] ?></td>
                                    <td class="p-3"><?= $data['jenis_kelamin'] ?></td>
                                    <td class="p-3"><?= $data['kta'] ?></td>
                                    <td class="p-3"><?= $data['jabatan'] ?></td>
                                    <td class="p-3"><?= $data['angkatan'] ?></td>
                                    <td class="p-3" style="min-width: 250px;">
                                        <?php if (isset($backup)) : ?>
                                            <button onclick="konfirmasiRestore('restoreMember/<?= $data['id_member']; ?>,backupMember')" class="btn btn-success fw-bold text-white me-2">Restore Data</button>
                                            <button onclick="konfirmasiPermanent('deleteMember/<?= $data['id_member']; ?>/backupMember')" class="btn btn-danger fw-bold me-2">Hapus</button>
                                        <?php else : ?>
                                            <button id="view<?= $id++; ?>" data-ids="<?= $data['id_member']; ?>" class="btn btn-info fw-bold text-white me-2">Lihat</button>
                                            <?php if (session()->get('masterjabatan')) : ?>
                                                <button id="jabatan<?= $idd++; ?>" data-idj="<?= $data['id_member']; ?>" class="btn btn-success fw-bold text-white me-2">Atur Jabatan</button>
                                            <?php endif; ?>
                                            <?php if (session()->get('mastermember') or session()->get('level') == 'admin') : ?>
                                                <button id="edit<?= $ids++; ?>" data-id="<?= $data['id_member']; ?>" class="btn btn-warning fw-bold text-white me-2">Edit</button>
                                                <button onclick="konfirmasiDel('delMember/<?= $data['id_member']; ?>,member')" class="btn btn-danger fw-bold me-2">Hapus</button>
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
                url: `<?= base_url() ?>/moderator`,
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
                url: `<?= base_url() ?>/moderator/${key}`,
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
                url: `<?= base_url() ?>/addMember`,
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

        for (let i = 1; i <= <?= count($member) ?>; i++) {
            $(`#edit${i}`).click(function() {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: `<?= base_url() ?>/memberEdit/${id}`,
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
                    url: `<?= base_url() ?>/member/${id}`,
                    dataType: 'html',
                    type: "GET",
                    beforeSend: function() {
                        load.show();
                    },
                    success: (respond) => {
                        $('#root').html(`${respond}`);
                        list.html("profile");
                    },
                });
            });
            $(`#jabatan${i}`).click(function() {
                let id = $(this).attr('data-idj');
                $.ajax({
                    url: `<?= base_url() ?>/positionMember/${id}`,
                    dataType: 'html',
                    type: "GET",
                    beforeSend: function() {
                        load.show();
                    },
                    success: (respond) => {
                        $('#root').html(`${respond}`);
                        list.html("position");
                    },
                });
            });
        }


    })
</script>
<?= $this->include('layout/datatable') ?>