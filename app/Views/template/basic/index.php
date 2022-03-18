<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="container">
    <section class="slider bg-dark rounded shadow-sm mt-5">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <?php
            // memasukan array transisi
            $transisi = [];
            for ($i = 1; $i <= 5; $i++) {
                if (session()->get("slide$i" . 'app') != "") {
                    array_push($transisi, session()->get("slide$i" . 'app'));
                }
            }

            ?>
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <?php for ($i = 1; $i < count($transisi); $i++) : ?>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $i; ?>" aria-label="Slide <?= $i + 1; ?>"></button>
                <?php endfor; ?>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item text-center active">
                    <img src="<?= base_url('/data/organisasi/slide/' . session()->get('slide1app')) ?>" class="d-block w-100 rounded imgslide" alt="...">

                </div>
                <?php for ($i = 1; $i < count($transisi); $i++) : ?>
                    <div class="carousel-item text-center">
                        <img src="<?= base_url('/data/organisasi/slide/' . $transisi[$i]) ?>" class="d-block w-100 rounded imgslide" alt="...">

                    </div>
                <?php endfor; ?>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section class="post mt-5">
        <h2 class="text-center <?= session()->get('font') ?> ">Postingan <span class="bg-<?= session()->get('color'); ?> rounded ps-3 pe-3 text-white">Terbaru</span> </h2>
        <hr>
        <div class="row p-2 d-flex justify-content-evenly">
            <?php if (count($postingan) > 0) : ?>
                <?php $id = 1; ?>
                <?php foreach ($postingan as $data) : ?>
                    <div class="col-md-4 bg-white p-2 pt-3 pb-3 mb-3 posting">

                        <div class="row">

                            <div class="col-md-12 text-center">
                                <img style="min-height:200px;max-height:200px;" class="rounded shadow-sm border" src="<?= base_url('/data/postingan/' . $data['file']) ?>" alt="" width="100%">
                            </div>
                        </div>
                        <div class="col-12">
                            <a href="#" class="text-decoration-none text-dark">
                                <h5 id="view<?= $id++; ?>" data-id="<?= $data['id_postingan']; ?>" class="fw-bold text-dark pt-2"><?= $data['judul_postingan']; ?></h5>
                            </a>
                        </div>

                        <div class="col-12 d-flex ">
                            <?php
                            $time = explode(' ', $data['created_at']);
                            $date = explode('-', $time[0]);
                            $minitime = explode(':', $time[1]);
                            ?>
                            <small><span class="description text-secondary"><?= $date[2] . '-' . $date[1] . '-' . $date[0] . ' ' ?></span></small><small class="text-secondary"> | </small>
                            <small><span class="description text-secondary"> <?= $minitime[0] . ':' . $minitime[1] ?></span></small>
                        </div>
                    </div>
                <?php endforeach;; ?>
                <div class="col-12 text-center mb-2">
                    <small id="postview" class="fw-bold btn btn-<?= session()->get('color') ?>"><i class="fas fa-search"></i> Lihat Selengkapnya</small>

                </div>
                <hr>
            <?php else : ?>
                <p class="text-center fw-bold text-secondary">Belum ada postingan yang tersedia</p>
            <?php endif; ?>
        </div>

    </section>
</div>
<script>
    $(document).ready(() => {
        let app = $("#app");
        const baseurl = $("#baseurl").val();
        let load = $("#load");

        load.hide();
        for (let i = 1; i <= <?= count($postingan) ?>; i++) {

            $(`#view${i}`).click(function() {
                let id = $(this).attr('data-id');
                $.ajax({
                    url: `<?= base_url() ?>/viewpost/${id}`,
                    dataType: 'html',
                    type: "GET",
                    beforeSend: function() {
                        load.show();
                    },
                    success: (respond) => {
                        $('#app').html(`${respond}`);
                    },
                });
            });
        }
    })
</script>