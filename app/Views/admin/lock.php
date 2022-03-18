<div style="margin-top: 0;" class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
        <!-- User name -->
        <div class="lockscreen-name">Pin Anda</div>

        <!-- START LOCK SCREEN ITEM -->
        <div class="lockscreen-item">
            <!-- lockscreen image -->
            <div class="lockscreen-image">
                <img src="<?= base_url('/img/iconapp.jpg') ?>" alt="User Image">
            </div>
            <!-- /.lockscreen-image -->

            <!-- lockscreen credentials (contains the form) -->
            <form id="cekpin" class="lockscreen-credentials">
                <div class="input-group">
                    <div id="token">
                        <?= csrf_field() ?>
                    </div>
                    <input type="password" name="pin" id=pin class="form-control " placeholder="Masukan Pin Anda">

                    <div class="input-group-append">
                        <button type="submit" class="btn">
                            <i class="fas fa-arrow-right text-muted"></i>
                        </button>
                    </div>
                </div>
            </form>
            <!-- /.lockscreen credentials -->

        </div>
        <!-- /.lockscreen-item -->
        <div id="msgpin" class="help-block text-center p-3">
            <p class="text-dark fw-bold">Masukan Pin untuk membuka Pengaturan </p>
        </div>

    </div>
    <!-- /.center -->
</div>
<script>
    $(document).ready(() => {
        let load = $("#load");

        load.hide();
        // tarik data
        function getData(link) {
            $.ajax({
                url: `<?= base_url() ?>/${link}`,
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
        $('#cekpin').submit(function(e) {
            e.preventDefault();
            let postData = new FormData(this)
            $.ajax({
                url: `<?= base_url() ?>/cekpin`,
                dataType: 'json',
                type: "POST",
                processData: false,
                contentType: false,
                cache: false,
                data: postData,
                beforeSend: function() {
                    load.show();
                },
                success: (respond) => {
                    if (respond.error == true) {
                        $('#msgpin').html(` <p class="text-danger fw-bold">${respond.messages}</p>`)
                        $('#pin').addClass('is-invalid')
                        $("#token").html(respond.token);
                    } else {
                        getData('organisasi');
                        dataAplikasi();
                    }
                },
            })
        })
    })
</script>