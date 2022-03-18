<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header bg-secondary">
                <h3 class="card-title">Tambah Postingan</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">

                <div class="form-group">

                    <label for="judul_postingan">Judul Postingan</label>
                    <input type="text" maxlength="100" class="form-control" id="judul_postingan" name="judul_postingan" placeholder="Masukan Judul Postingan" required>
                    <small>Bata Inputan judul adalah 100 karakter</small>
                </div>
                <div class="form-group">
                    <label for="postingan">Isi Postingan</label>
                    <div id="editor">
                        <textarea class="form-control" name="postingan" rows="3" required></textarea>
                    </div>
                </div>

                <form id="add">
                    <div class="token">
                        <?= csrf_field() ?>
                    </div>
                    <input type="hidden" name="angkatan" value="<?= session()->get('angkatanapp') ?>">
                    <div class="form-group">
                        <label for="ditujukan">Ditujukan</label>
                        <select id="ditujukan" name="ditujukan" class="custom-select" required>
                            <option value="" selected>--Pilih--</option>
                            <option value="publik">Publik</option>
                            <option value="member">Member</option>
                        </select>
                    </div>
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-info"></i> Harap dibaca!</h5>
                        <ul>
                            <li>ketika Publik maka postingan dapat dilihat oleh publik dan akan tampil pada website dan dahsboard</li>
                            <li>Ketika memilih Member postingan hanya dapat dilihat oleh Member Organisasi</li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload Gambar Postingan (Format : png,jpeg,jpg)</label>
                        <input class="form-control " type="file" id="file" name="file" required>
                        <p id="msgfile" class="text-danger"></p>
                    </div>
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-info"></i> Harap dibaca!</h5>
                        <ul>
                            <li>Ukuran Maximal gambar tidak boleh lebih dari 2mb</li>
                        </ul>
                    </div>
                    <button id="simpan" type="submit" class="btn btn-primary">Simpan</button>
                    <h4 id="batal" class="btn btn-danger ms-2 mt-2">Batal</h4>
                </form>

            </div>

        </div>
    </div>
    <!-- /.card-body -->


</div>
<!-- /.card -->
</div>
</div>
<?= $this->include('layout/ckeditor'); ?>
<script>
    $(document).ready(() => {
        let load = $("#load");
        let list = $("#listpage");
        load.hide();
        // tarik data
        function getData() {
            $.ajax({
                url: `<?= base_url('/postingan') ?>`,
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

        // add postingan
        $('#add').submit(function(e) {
            e.preventDefault()

            let postingan = $('.ck-content').html()
            let judulpostingan = $('#judul_postingan').val()
            let postdata = new FormData(this);

            if (judulpostingan == '') {
                $('#judul_postingan').addClass('is-invalid')
            } else {
                $('#judul_postingan').removeClass('is-invalid')
                // menambahkan data
                postdata.append('postingan', postingan)
                postdata.append('judul_postingan', judulpostingan)

                $.ajax({
                    url: `<?= base_url() ?>/postingan`,
                    dataType: 'json',
                    enctype: 'multipart/form-data',
                    type: "POST",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: postdata,
                    beforeSend: function() {
                        load.show();
                    },
                    success: (respond) => {
                        if (respond.error == true) {
                            $('#file').addClass('is-invalid')
                            $('#msgfile').html(respond.messages)
                            $(".token").html(respond.token);
                            load.hide();
                        } else if (respond.error == null) {
                            $('#file').removeClass('is-invalid')
                            $('#msgfile').html('')
                            getData();
                            dataBerhasil();
                        }

                    },

                })
            }



        })
        // Batal 
        $('#batal').click(() => {
            getData();
        })




    })
</script>