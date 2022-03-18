<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="container">

    <section class="post mt-5 ">
        <div class="row d-flex justify-content-center">
            <?php foreach ($bidang as $data) : ?>
                <div class="col-md-10 m-2 shadow p-3 mb-4">
                    <h5 class="text-center <?= session()->get('font') ?> program"><span class="">Bidang </span><span class="bg-<?= session()->get('color') ?> rounded ps-3 pe-3 text-white"><?= $data['bidang']; ?></span> </h5>
                    <div class="row p-2 d-flex justify-content-evenly">
                        <div class="col-12 mb-5">
                            <table>

                                <?php foreach ($program as $prg) : ?>
                                    <?php if ($data['bidang'] == $prg['bidang']) : ?>
                                        <tr>
                                            <td>
                                                <li class="fw-bold text-dark f-1"> </li>
                                            </td>
                                            <td class="fw-bold listf">
                                                <?= $prg['program']; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
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