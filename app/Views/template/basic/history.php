<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="container">

    <section class="post mt-5">
        <h2 class="text-center <?= session()->get('font') ?> ">Sejarah <span class="bg-<?= session()->get('color') ?> rounded ps-3 pe-3 text-white">Organisasi</span> </h2>
        <hr>
        <div class="row p-2 ">
            <div class="col-12 ">
                <?= nl2br($organisasi[0]['sejarah']) ?>
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