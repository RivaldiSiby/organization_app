<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header bg-secondary">
        <h3 class="card-title">Edit Surat</h3>
      </div>
      <!-- /.card-header -->

      <div class="card-body">
        <form id="add">
          <div class="form-group">
            <div class="token">
              <?= csrf_field() ?>
            </div>
            <input type="hidden" name="id_surat" value="<?= $surat['id_surat']; ?>">
            <label for="nomor_surat">Nomor Surat</label>
            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" placeholder="Masukan Nomor Surat" value="<?= $surat['nomor_surat']; ?>" required>
          </div>
          <div class="form-group">
            <label for="judul_surat">Judul Surat</label>
            <input type="text" class="form-control" id="judul_surat" name="judul_surat" placeholder="Masukan Judul Surat" value="<?= $surat['judul_surat']; ?>" required>
          </div>
          <div class="form-group">
            <label for="jenis_surat">Jenis Surat</label>
            <select id="jenis_surat" name="jenis_surat" class="custom-select" required>
              <?php if ($surat['jenis_surat'] == 'Surat Masuk') : ?>
                <option value="Surat Masuk" selected>Surat Masuk</option>
                <option value="Surat Keluar">Surat keluar</option>
              <?php else : ?>
                <option value="Surat Keluar" selected>Surat keluar</option>
                <option value="Surat Masuk">Surat Masuk</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="publikasi">Publikasi Surat</label>
            <select id="publikasi" name="publikasi" class="custom-select" required>
              <?php if ($surat['publikasi'] == 'no') : ?>
                <option value="no" selected>Jangan Publikasi</option>
                <option value="yes">Publikasi Surat</option>
              <?php else : ?>
                <option value="yes" selected>Publikasi Surat</option>
                <option value="no">Jangan Publikasi</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i> Harap dibaca!</h5>
            <ul>
              <li>Publikasi Surat akan memungkinkan surat dilihat oleh seluruh Anggota Organisasi</li>
              <li>ketika tidak Mempuplikasi maka surat hanya dapat dilihat oleh moderator/pengurus Organisasi</li>

            </ul>
          </div>
          <div class="mb-3">
            <label for="file" class="form-label">Upload Surat (Pdf/Word/Excel)</label>
            <input class="form-control " type="file" id="file" name="file">
            <p id="msgfile" class="text-danger"></p>
            <p>Jika tidak ingin mengganti File pada surat form upload file tidak perlu di isi</p>
          </div>
          <input type="hidden" name="angkatan" id="angkatan" value="<?= session()->get('angkatanapp') ?>">
          <button id="simpan" type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
<script>
  $(document).ready(() => {
    let load = $("#load");
    let list = $("#listpage");
    load.hide();
    // tarik data
    function getData() {
      $.ajax({
        url: `<?= base_url('/surat') ?>`,
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

    // add Surat
    $('#add').submit(function(e) {
      e.preventDefault()
      let postdata = new FormData(this);
      $.ajax({
        url: `<?= base_url() ?>/editSurat`,
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
            dataUbah();
          }

        },

      })


    })


    // Batal 
    $('#batal').click(() => {
      getData();
    })




  })
</script>