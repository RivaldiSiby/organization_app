<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header bg-secondary">
                <h3 class="card-title">Tambah Kegiatan</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">

                <div class="form-group">

                    <label for="kegiatan">Kegiatan</label>
                    <input type="text" maxlength="100" class="form-control" id="kegiatan" name="kegiatan" placeholder="Masukan Kegiatan" required>
                    <small>Batas Inputan kegiatan adalah 100 karakter</small>
                </div>
                <div class="form-group">
                    <label for="pesan_kegiatan">Pesan Kegiatan</label>
                    <div id="editor">
                        <textarea class="form-control" name="pesan_kegiatan" rows="3" required></textarea>
                    </div>
                </div>

                <form id="add">
                    <div class="token">
                        <?= csrf_field() ?>
                    </div>
                    <input type="hidden" name="angkatan" value="<?= session()->get('angkatanapp') ?>">
                    <!-- Date and time -->
                    <div class="form-group">
                        <label>Waktu Mulai Kegiatan</label>
                        <input type="datetime-local" class="form-control" id="mulai_kegiatan" name="mulai_kegiatan" required>

                    </div>
                    <div class="form-group">
                        <label>Waktu Selesai Kegiatan</label>
                        <input type="datetime-local" class="form-control" id="selesai_kegiatan" name="selesai_kegiatan" required>

                    </div>
                    <!-- /.form group -->
                    <div class="form-group">
                        <label for="ditujukan">Ditujukan</label>
                        <select id="ditujukan" name="ditujukan" class="custom-select" required>
                            <option value="" selected>--Pilih--</option>
                            <option value="publik">Publik</option>
                            <option value="member">Member</option>
                            <option value="private">Private</option>
                        </select>
                    </div>
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-info"></i> Harap dibaca!</h5>
                        <ul>
                            <li>ketika Publik maka Kegiatan dapat dilihat oleh publik dan akan tampil pada website dan dahsboard</li>
                            <li>Ketika memilih Member Kegiatan hanya dapat dilihat oleh Member Organisasi</li>
                            <li>Ketika memilih Private Kegiatan hanya dapat dilihat oleh Moderator Organisasi</li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload Gambar Kegiatan (Format : png,jpeg,jpg)</label>
                        <input class="form-control " type="file" id="file" name="file">
                        <p id="msgfile" class="text-danger"></p>
                    </div>
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-info"></i> Harap dibaca!</h5>
                        <ul>
                            <li>Ukuran Maximal gambar tidak boleh lebih dari 2mb</li>
                            <li>Jika tidak ingin memasukan gambar silahkan kosongkan input file</li>
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
                url: `<?= base_url('/kegiatan') ?>`,
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

        // add kegiatan
        $('#add').submit(function(e) {
            e.preventDefault()

            let kegiatan = $('.ck-content').html()
            let judulkegiatan = $('#kegiatan').val()
            let postdata = new FormData(this);

            if (judulkegiatan == '') {
                $('#kegiatan').addClass('is-invalid')
            } else {
                $('#kegiatan').removeClass('is-invalid')
                // menambahkan data
                postdata.append('pesan_kegiatan', kegiatan)
                postdata.append('kegiatan', judulkegiatan)

                $.ajax({
                    url: `<?= base_url() ?>/kegiatan`,
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