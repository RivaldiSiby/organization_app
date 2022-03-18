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
                <h2 class="fw-bold"><?= $postingan['judul_postingan'] ?></h2>
                <div class="col-12 d-flex justify-content-between mt-1 mb-2 border">
                    <?php
                    $time = explode(' ', $postingan['created_at']);
                    $date = explode('-', $time[0]);
                    ?>
                    <small class="fw-bold"><span class="description text-secondary">Dibuat pada - <?= $date[2] . '-' . $date[1] . '-' . $date[0] ?></span></small>
                    <small class="fw-bold"><span class="description text-secondary"><?= $time[1] ?></span></small>
                </div>
                <?php if ($postingan['file'] != '') : ?>
                    <div class="col-12 text-center mb-2 ">
                        <img class="imgslide" src="<?= base_url('/data/postingan/' . $postingan['file']) ?>" width="100%" alt="">
                    </div>
                <?php endif; ?>
                <div>
                    <?= $postingan['postingan']; ?>
                </div>
                <?php if (session()->get('level' == 'admin')) : ?>
                    <div class="col-12 mt-3 text-end">
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
                url: `<?= (session()->get('masterpostingan')) ? base_url('/postingan') : base_url('/apiPostingan') ?>`,
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