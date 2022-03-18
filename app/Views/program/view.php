<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row bg-white">
    <section class="post mt-3 p-4">
        <?php foreach ($bidang as $data) : ?>
            <div class="">
                <h3 class="text-start fontapp">Bidang <span class="bg-primary rounded ps-3 pe-3 text-white"><?= $data['bidang']; ?></span> </h3>
                <div class="row p-2 d-flex justify-content-evenly">
                    <div class="col-12 mb-5">
                        <table>

                            <?php foreach ($program as $prg) : ?>
                                <?php if ($data['bidang'] == $prg['bidang']) : ?>
                                    <tr>
                                        <td>
                                            <li class="fw-bold text-dark f-1"> </li>
                                        </td>
                                        <td class="fw-bold">
                                            <?= $prg['program']; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
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