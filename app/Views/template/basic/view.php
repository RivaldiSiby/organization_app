<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="container">

    <section class="post mt-5">
        <h2 class="text-<?= session()->get('color') ?>"><?= $postingan['judul_postingan']; ?></h2>

        <div class="col-12 d-flex justify-content-between mt-1 mb-2 border">
            <?php
            $time = explode(' ', $postingan['created_at']);
            $date = explode('-', $time[0]);
            ?>
            <small class="fw-bold"><span class="description text-secondary">Dibuat pada - <?= $date[2] . '-' . $date[1] . '-' . $date[0] ?></span></small>
            <small class="fw-bold"><span class="description text-secondary"><?= $time[1] ?></span></small>
        </div>
        <div class="row p-2 ">

            <div class="col-12 text-center">
                <img class="imgslide" width="100%" src="<?= base_url('/data/postingan/' . $postingan['file']) ?>" alt="">
            </div>
            <div class="col-12 mt-3">
                <?= nl2br($postingan['postingan']) ?>
            </div>
        </div>

    </section>

</div>
<script>
    $(document).ready(() => {
        let app = $("#app");
        const baseurl = $("#baseurl").val();
        let load = $("#load");

        load.hide();

    })
</script>