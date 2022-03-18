<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header bg-secondary">
        <h3 class="card-title">Edit Laporan Keuangan</h3>
      </div>
      <!-- /.card-header -->

      <div class="card-body">
        <form id="add">
          <div class="form-group">
            <div class="token">
              <?= csrf_field() ?>
            </div>
            <input type="hidden" name="id_laporan" value="<?= $keuangan['id_laporan']; ?>">
            <label for="nomor_laporan">Nomor Laporan Keuangan</label>
            <input type="text" class="form-control" id="nomor_laporan" name="nomor_laporan" placeholder="Masukan Nomor laporan keuangan" value="<?= $keuangan['nomor_laporan']; ?>" required>
          </div>
          <div class="form-group">
            <label for="judul_laporan">Judul Laporan Keuangan</label>
            <input type="text" class="form-control" id="judul_laporan" name="judul_laporan" placeholder="Masukan Judul laporan keuangan" value="<?= $keuangan['judul_laporan']; ?>" required>
          </div>
          <div class="form-group">
            <label for="publikasi">Publikasi Laporan Kuangan</label>
            <select id="publikasi" name="publikasi" class="custom-select" required>
              <?php if ($keuangan['publikasi'] == 'no') : ?>
                <option value="no" selected>Jangan Publikasi</option>
                <option value="yes">Publikasi Laporan Kuangan</option>
              <?php else : ?>
                <option value="yes" selected>Publikasi Laporan Kuangan</option>
                <option value="no">Jangan Publikasi</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i> Harap dibaca!</h5>
            <ul>
              <li>Publikasi Laporan Keuangan akan memungkinkan Laporan Keuangan dilihat oleh seluruh Anggota Organisasi</li>
              <li>ketika tidak Mempuplikasi maka Laporan Keuangan hanya dapat dilihat oleh moderator/pengurus Organisasi</li>

            </ul>
          </div>
          <div class="mb-3">
            <label for="file" class="form-label">Upload Laporan Keuangan (Pdf/Word/Excel)</label>
            <input class="form-control " type="file" id="file" name="file">
            <p id="msgfile" class="text-danger"></p>
            <p>Jika tidak ingin mengganti File pada Laporan Keuangan form upload file tidak perlu di isi</p>
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
    load.hide();
    let list = $("#listpage");
    // tarik data
    function getData() {
      $.ajax({
        url: `<?= base_url('/keuangan') ?>`,
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

    // add keuangan
    $('#add').submit(function(e) {
      e.preventDefault()
      let postdata = new FormData(this);
      $.ajax({
        url: `<?= base_url() ?>/editKeuangan`,
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