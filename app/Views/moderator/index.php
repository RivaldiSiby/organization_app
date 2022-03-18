<?= $this->include('layout/sweetalert') ?>
<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary ">
                <h3 class="card-title">Moderator</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body table-responsive p-0 p-3">
                <div class="col-12 text-end">
                    <button id="tambah" class="me-2 mb-2 btn btn bg-gradient-success ">Tambah Moderator</button>
                </div>

                <table class="table table-hover text-nowrap">
                    <thead class="bg-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Moderator</th>
                            <th>Rules</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomor = 1;
                        $no = 1;
                        $nn = 1;
                        $nmo = 1;
                        $mmm = 1;
                        $nmn = 1;
                        $id = 1;
                        $ids = 1;
                        ?>
                        <?php foreach ($moderator as $data) : ?>
                            <tr>
                                <td class="pt-4"><?= $nomor++; ?></td>
                                <td class="pt-4"><?= $data['nama_moderator'] ?></td>
                                <td style="min-width:150px;">
                                    <div class="accordion accordion-flush shadow-sm" id="pengelompokan">
                                        <div class="accordion-item ">
                                            <h2 class="accordion-header" id="flush<?= $no++ ?>">
                                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flushc<?= $nmo++; ?>" aria-expand fw-bold="false" aria-controls="flushc<?= $mmm++; ?>">
                                                    Fitur Moderator
                                                </button>
                                            </h2>
                                            <div id="flushc<?= $nmn++; ?>" class="accordion-collapse collapse" aria-labell fw-boldby="flush<?= $nn++ ?>" data-bs-parent="#pengelompokan">
                                                <div class="accordion-body fw-bold text-dark">
                                                    <?php $list = explode(',', $data['rules']) ?>
                                                    <?php foreach ($list as $li) : ?>
                                                        <li><?= $li; ?></li>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="pt-4 text-center">
                                    <button id="edit<?= $id++; ?>" data-id="<?= $data['id_moderator']; ?>" class="btn btn-warning fw-bold text-white">Edit</button>
                                    <button onclick="konfirmasiPermanent('deleteModerator/<?= $data['id_moderator']; ?>/moderator')" id="hapus<?= $ids++; ?>" data-id="<?= $data['id_moderator']; ?>" class="btn btn-danger fw-bold me-2">Hapus</button>

                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <?php if (count($moderator) == 0) : ?>
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
                url: `<?= base_url() ?>/addModerator`,
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

        for (let i = 1; i <= <?= count($moderator) ?>; i++) {
            $(`#edit${i}`).click(function() {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: `<?= base_url() ?>/moderator/${id}`,
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