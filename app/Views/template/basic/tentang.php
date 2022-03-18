<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="container">

    <section class="post mt-5">
        <h2 class="text-center <?= session()->get('font') ?> "><u>Tentang</u> <span class="bg-<?= session()->get('color') ?> rounded ps-3 pe-3 text-white">Kami</span> </h2>
        <hr>
        <div class="row d-flex justify-content-center ">
            <div class="col-10">
                <h4 class="<?= session()->get('font') ?> bg-dark text-white fw-bol mt-5">Tentang <span class="bg-<?= session()->get('color') ?> rounded ps-3 pe-3 text-white">Organisasi</span> </h4>

            </div>
            <div class="col-md-4 mt-4 text-center">
                <img style="max-height: 130px;" width="60%" src="<?= base_url('/data/organisasi/logo/' . session()->get('logoapp')) ?>" alt="">
            </div>
            <div class="col-md-8 pt-2 pb-2  mt-4 ">
                <h3><?= $organisasi[0]['nama_organisasi']; ?></h3>
                <p>
                    <u>Lorem ipsum,</u> dolor sit amet consectetur adipisicing elit. Sit cumque fugit cupiditate provident quod impedit minus dignissimos, voluptas animi? Quo commodi quidem ducimus voluptatibus a porro ea mollitia similique dolor.
                </p>

            </div>
        </div>
        <div class="row d-flex justify-content-center ">
            <div class="col-10">
                <h4 class="<?= session()->get('font') ?> bg-dark text-white fw-bol mt-5">Visi <span class="bg-<?= session()->get('color') ?> rounded ps-3 pe-3 text-white">Misi</span> </h4>

            </div>
            <div class="col-10 mt-4">
                <?= nl2br($organisasi[0]['visi_misi']) ?>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-10">
                <h4 class="<?= session()->get('font') ?> bg-dark text-white fw-bol mt-5">Kontak <span class="bg-<?= session()->get('color') ?> rounded ps-3 pe-3 text-white">Kami</span> </h4>
            </div>
            <div class="col-10 mt-4 mb-4">
                <?php if ($organisasi[0]['ig'] != '') : ?>
                    <li class="fw-bold">
                        Instagram : <?= $organisasi[0]['ig']; ?>
                    </li>
                <?php endif; ?>
                <?php if ($organisasi[0]['wa'] != '') : ?>
                    <li class="fw-bold">
                        Wa : <?= $organisasi[0]['wa']; ?>
                    </li>
                <?php endif; ?>
                <?php if ($organisasi[0]['fb'] != '') : ?>
                    <li class="fw-bold">
                        Facebook : <?= $organisasi[0]['fb']; ?>
                    </li>
                <?php endif; ?>
                <?php if ($organisasi[0]['email'] != '') : ?>
                    <li class="fw-bold">
                        Email : <?= $organisasi[0]['email']; ?>
                    </li>
                <?php endif; ?>
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