<div class="row p-2 d-flex bg-white " style="min-height:90vh;">
    <?php $id = 1; ?>
    <div class=" col-12">
        <h2 class="fw-bold  text-center"><span style="border-bottom:solid 3px #007BFF">Postingan</span></h2>
    </div>
    <?php foreach ($postingan as $data) : ?>

        <div class="col-md-4 bg-white p-2 pt-3 pb-3 mb-3 ">

            <div class="row">

                <div class="col-md-12 text-center">
                    <img style="min-height:200px;max-height:200px;" class="rounded shadow-sm border" src="<?= base_url('/data/postingan/' . $data['file']) ?>" alt="" width="90%">
                </div>
            </div>

            <a href="#">
                <h4 id="views<?= $id++; ?>" data-ids="<?= $data['id_postingan']; ?>" class="fw-bold text-primary pt-2"><?= $data['judul_postingan']; ?></h4>
            </a>
            <div class="col-12 d-flex justify-content-between">
                <?php
                $time = explode(' ', $data['created_at']);
                $date = explode('-', $time[0]);
                ?>
                <small class="fw-bold"><span class="description text-secondary">Dibuat pada - <?= $date[2] . '-' . $date[1] . '-' . $date[0] ?></span></small>
                <small class="fw-bold"><span class="description text-secondary"><?= $time[1] ?></span></small>
            </div>
        </div>
    <?php endforeach;; ?>
    <?php if (count($postingan) == 0) : ?>
        <p class="text-center fw-bold text-secondary p-3"> <i class="far fa-newspaper nav-icon"></i> Belum ada Postingan yang tersedia</p>
    <?php endif; ?>
</div>

<script>
    $(document).ready(() => {
        let title = $("#hpage");
        let title2 = $("#hpage2");
        let list = $("#listpage");
        let load = $("#load");
        load.hide();
        for (let i = 1; i <= <?= count($postingan) ?>; i++) {
            $(`#views${i}`).click(function() {
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
                        title.html("Postingan");
                        title2.html("Postingan");
                    },
                });
            });
        }
    })
</script>