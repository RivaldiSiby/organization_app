<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header bg-secondary">
        <h3 class="card-title">Edit Member</h3>
      </div>
      <!-- /.card-header -->

      <div class="card-body">
        <form id="add">
          <input type="hidden" name="id_member" value="<?= $member['id_member']; ?>">
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i> Harap dibaca!</h5>
            <ul>
              <li>Jika ingin mengganti Password bisa mengklik tombol Ganti Password</li>
              <li>Jika ingin mengganti Foto bisa mengklik tombol Ganti Foto</li>
              <li>Gambar harus berformat jpg,png,jpeg</li>
              <li>Ukuran Maximal gambar tidak boleh lebih dari 1mb</li>
            </ul>
          </div>
          <div class="form-group">
            <div class="token">
              <?= csrf_field() ?>
            </div>

            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Member" value="<?= $member['nama']; ?>" required>
          </div>

          <label id="lpass">Password</label>
          <div id="passbox">

          </div>
          <h4 id="cpass" class="btn btn-success">Ganti Password</h4>
          <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="custom-select" required>
              <?php if ($member['jenis_kelamin'] == "Laki-laki") : ?>
                <option value="Laki-laki" selected>Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              <?php else : ?>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan" selected>Perempuan</option>
              <?php endif; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukan Tempat Lahir Member" value="<?= $member['tempat_lahir']; ?>" required>
          </div>
          <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $member['tanggal_lahir']; ?>" required>
          </div>
          <input type="hidden" id="angkatan" name="angkatan" value="<?= $member['angkatan']; ?>" required>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat" value="<?= $member['alamat']; ?>" required>
          </div>
          <div class="form-group">
            <label for="kta">Nomor kta</label>
            <input type="text" class="form-control" id="kta" name="kta" placeholder="Masukan Nomor kta" value="<?= $member['kta']; ?>">
          </div>
          <label id="lfile">Foto</label>
          <div id="fotobox" class="mb-3">

          </div>
          <h4 id="cfoto" class="btn btn-success">Ganti Foto</h4>
          <?php if (session()->get('level') == 'admin') : ?>
            <div class="form-group">
              <label for="jabatan">Jabatan</label>
              <select id="jabatan" name="jabatan" class="custom-select">
                <option value="<?= $member['jabatan']; ?>" selected><?= $member['jabatan']; ?></option>
                <?php foreach ($moderator as $data) : ?>
                  <?php if ($member['jabatan'] != $data['nama_moderator']) : ?>
                    <option value="<?= $data['nama_moderator']; ?>"><?= $data['nama_moderator']; ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
                <?php foreach ($bidang as $data) : ?>
                  <?php if ($member['jabatan'] != $data['bidang']) : ?>
                    <option value="<?= $data['bidang']; ?>">Bidang <?= $data['bidang']; ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
                <?php if ($member['jabatan'] != 'Member') : ?>
                  <option value="Member">Member</option>
                <?php endif; ?>
              </select>
            </div>
          <?php else : ?>
            <input type="hidden" name="jabatan" value="Member">
          <?php endif; ?>
          <div class="col-12 mt-2">
            <button id="simpan" type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <h4 id="batal" class="btn btn-danger ms-2 mt-2">Batal</h4>
          </div>

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
    // ganti pass
    $('#cpass').click(() => {
      $('#passbox').html(`
      <div class="form-group">
      <input type="hidden" id="valpass" value="password">
        <label for="password">Password</label>
        <input type="password" class="form-control " id="password" name="password" placeholder="Masukan password Member" required>
        <p id="msgpass" class="text-danger"></p>
      </div>
      <input type="hidden" id="valpas" value="password">
      <div class="form-group">
        <label for="kpassword">Konfirmasi Password</label>
        <input type="password" class="form-control" id="kpassword" placeholder="Masukan Konfirmasi password Member" required>
        <p id="msgkpass" class="text-danger"></p>
      </div>
      <h4 id="bpass" class="btn btn-danger">Batal</h4>
      `)
      $('#cpass').addClass('d-none')
      $('#lpass').addClass('d-none')
      $('#bpass').click(() => {
        $('#cpass').removeClass('d-none')
        $('#passbox').html('')
        $('#lpass').removeClass('d-none')
      })

    })
    // ganti foto
    $('#cfoto').click(() => {
      $('#fotobox').html(`
      <label for="foto" class="form-label">Upload Foto Baru</label>
      <input class="form-control " type="file" id="foto" name="foto" required>
      <p id="msgfoto" class="text-danger"></p>
      <h4 id="bfoto" class="btn btn-danger">Batal</h4>
      `)
      $('#cfoto').addClass('d-none')
      $('#lfile').addClass('d-none')
      $('#bfoto').click(() => {
        $('#cfoto').removeClass('d-none')
        $('#fotobox').html('')
        $('#lfile').removeClass('d-none')
      })

    })

    // add Member
    $('#add').submit(function(e) {
      e.preventDefault()
      let postdata = new FormData(this);
      let validasipass = false;
      let pas1 = false
      let pas2 = false

      if ($('#valpass').val() == 'password') {
        // validasi form
        let pass = $('#password').val();
        let kpass = $('#kpassword').val();
        pas1 = pass.length < 8
        pas2 = pass != kpass
        // validasi form
        validasipass = true;

      }

      if (validasipass == true) {
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

        if (pas1 == false && pas2 == false) {
          $.ajax({
            url: `<?= base_url() ?>/editMember`,
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
                getData();
                dataUbah();
              }

            },

          })
        }
      } else {
        $.ajax({
          url: `<?= base_url() ?>/editMember`,
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
              dataUbah();
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