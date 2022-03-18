<?= $this->include('layout/sweetalert') ?>
<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary ">
                <h3 class="card-title">Program Kerja</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body table-responsive p-0 p-3">
                <div class="col-12 text-end">
                    <button id="tambah" class="me-2 mb-2 btn btn bg-gradient-success ">Tambah Program</button>
                </div>
                <?php if (isset($jabatanbidang)) : ?>
                    <div class="col-12 ">
                        <h5 class="fw-bold"><?= $jabatanbidang ?></h5>
                    </div>
                <?php endif; ?>
                <table class="table table-hover text-nowrap ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Program Kerja</th>
                            <th>Bidang</th>
                            <th>Angkatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        $id = 1;
                        ?>
                        <?php foreach ($program as $data) : ?>
                            <tr>
                                <td class="pt-4"><?= $nomor++; ?></td>
                                <td style="min-width: 250px;" class="pt-4"><?= $data['program'] ?></td>
                                <td class="pt-4"><?= $data['bidang'] ?></td>
                                <td class="pt-4"><?= $data['angkatan'] ?></td>
                                <td class="pt-4 text-center">
                                    <button id="edit<?= $id++; ?>" data-id="<?= $data['id_program']; ?>" class="btn btn-warning fw-bold text-white">Edit</button>
                                    <button onclick="konfirmasiPermanent('deleteProgram/<?= $data['id_program']; ?>/program')" class="btn btn-danger fw-bold me-2">Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <?php if (count($program) == 0) : ?>
                <p class="text-center">Belum ada data yang tersedia</p>
            <?php endif; ?>
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
                url: `<?= base_url() ?>/program`,
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
                url: `<?= base_url() ?>/program/${key}`,
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
                url: `<?= base_url() ?>/addProgram`,
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

        for (let i = 1; i <= <?= count($program) ?>; i++) {
            $(`#edit${i}`).click(function() {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: `<?= base_url() ?>/program/${id}`,
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
        }


    })
</script>