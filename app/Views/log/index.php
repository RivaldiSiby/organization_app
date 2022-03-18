<?= $this->include('layout/sweetalert') ?>
<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary ">
                <h3 class="card-title">Log Activity</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body p-0 p-3">
                <div class="col-12 text-end p-2">
                    <?php if (session()->get('level') == 'admin') : ?>
                        <button onclick="konfirmasiClearLog('clearAll/log')" class="btn btn-danger fw-bold m-2">Bersihkan Semua Data</button>
                        <button onclick="konfirmasiClearLog('clearMonth/log')" class="btn btn-danger fw-bold m-2 ms-4">Bersihkan Data Bulan Ini</button>
                        <button onclick="konfirmasiClearLog('clearAngkatan/log')" class="btn btn-danger fw-bold m-2 ms-4">Bersihkan Data Angkatan Sekarang</button>
                    <?php endif; ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable" width="100%" cellspacing="0">
                        <thead class="bg-dark">
                            <tr>
                                <th class="text-center">Waktu</th>
                                <th>Aktifitas</th>
                                <th>Jenis Data</th>
                                <th>Angkatan</th>
                                <th>Pembuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = 1;
                            $ids = 1;
                            ?>
                            <?php foreach ($log as $data) : ?>
                                <?php
                                $time = explode(' ', $data['created_at']);
                                $date = explode('-', $time[0]);
                                ?>
                                <tr>
                                    <td class="p-3"><?= $date[2] . '-' . $date[1] . '-' . $date[0] . ' | ' . $time[1]  ?></td>
                                    <td class="p-3" style="min-width:150px;"><?= $data['activity'] ?></td>
                                    <td class="p-3"><?= $data['jenis_data'] ?></td>
                                    <td class="p-3"><?= $data['angkatan'] ?></td>
                                    <td class="p-3"><?= $data['jabatan'] ?></td>
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




    })
</script>
<?= $this->include('layout/datatable') ?>