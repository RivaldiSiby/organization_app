<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header bg-secondary">
        <h3 class="card-title">Tambah Member</h3>
      </div>
      <!-- /.card-header -->

      <div class="card-body">
        <form id="add">
          <div class="form-group">
            <div class="token">
              <?= csrf_field() ?>
            </div>
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Member" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control " id="password" name="password" placeholder="Masukan password Member" required>
            <p id="msgpass" class="text-danger"></p>
          </div>
          <div class="form-group">
            <label for="kpassword">Konfirmasi Password</label>
            <input type="password" class="form-control" id="kpassword" placeholder="Masukan Konfirmasi password Member" required>
            <p id="msgkpass" class="text-danger"></p>
          </div>
          <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="custom-select" required>
              <option value="" selected>--Pilih Jenis Kelamin--</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukan Tempat Lahir Member" required>
          </div>
          <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
          </div>
          <input type="hidden" id="angkatan" name="angkatan" value="<?= session()->get('angkatanapp') ?>" required>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat" required>
          </div>
          <div class="form-group">
            <label for="kta">Nomor kta</label>
            <input type="text" class="form-control" id="kta" name="kta" placeholder="Masukan Nomor kta">
          </div>
          <div class="mb-3">
            <label for="foto" class="form-label">Upload Foto</label>
            <input class="form-control " type="file" id="foto" name="foto">
            <p id="msgfoto" class="text-danger"></p>
          </div>
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i> Harap dibaca!</h5>
            <ul>
              <li>Gambar harus berformat jpg,png,jpeg</li>
              <li>Ukuran Maximal gambar tidak boleh lebih dari 1mb</li>
            </ul>
          </div>
          <?php if (session()->get('level') == 'admin') : ?>
            <div class="form-group">
              <label for="jabatan">Jabatan</label>
              <select id="jabatan" name="jabatan" class="custom-select">
                <option value="Member" selected>Member</option>
                <?php foreach ($moderator as $data) : ?>
                  <option value="<?= $data['nama_moderator']; ?>"><?= $data['nama_moderator']; ?></option>
                <?php endforeach; ?>
                <?php foreach ($bidang as $data) : ?>
                  <option value="<?= $data['bidang']; ?>">Bidang<?= $data['bidang']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          <?php else : ?>
            <input type="hidden" name="jabatan" value="Member">
          <?php endif; ?>
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
<script>
  $(document).ready(() => {
    let load = $("#load");
    load.hide();
    let list = $("#listpage");
    // tarik data
    function getData() {
      $.ajax({
        url: `<?= base_url('/member') ?>`,
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

    // add Member
    $('#add').submit(function(e) {
      e.preventDefault()
      let postdata = new FormData(this);

      // validasi form
      let pass = $('#password').val();
      let kpass = $('#kpassword').val();
      let pas1 = pass.length < 8
      let pas2 = pass != kpass

      // validasi form
      if (pas1) {
        $('#password').addClass('is-invalid');
        $('#msgpass').html('Password harus lebih dari 8 kombinasi huruf dan angka')
      } else {
        $('#password').removeClass('is-invalid');
        $('#msgpass').html('')
      }
      if (pas2) {
        $('#kpassword').addClass('is-invalid');
        $('#msgkpass').html('Konfirmasi password harus sama dengan password')
      } else {
        $('#kpassword').removeClass('is-invalid');
        $('#msgkpass').html('')
      }

      if (!pas1 && !pas2) {
        $.ajax({
          url: `<?= base_url() ?>/member`,
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
              $('#foto').addClass('is-invalid')
              $('#msgfoto').html(respond.messages)
              $(".token").html(respond.token);
              load.hide();
            } else if (respond.error == null) {
              $('#foto').removeClass('is-invalid')
              $('#msgfoto').html('')
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