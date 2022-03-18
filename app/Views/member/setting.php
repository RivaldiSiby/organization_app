<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header bg-secondary">
        <h3 class="card-title">Pengaturan Profile</h3>
      </div>
      <!-- /.card-header -->

      <div class="card-body">
        <form id="editprofile">
          <div class="form-group">
            <div class="token">
              <?= csrf_field() ?>
            </div>
            <label for="nama">Nama Anda</label>
            <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan Nama Anda" value="<?= $member['nama']; ?>" required>
          </div>
          <label for="foto" class="form-label">Upload Foto Baru</label>
          <input class="form-control " type="file" id="foto" name="foto">
          <p id="msgfoto" class="text-danger"></p>
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i> Harap dibaca!</h5>
            <ul>
              <li>Gambar harus berformat jpg,png,jpeg</li>
              <li>Ukuran Maximal gambar tidak boleh lebih dari 1mb</li>
            </ul>
          </div>
          <div class="col-12 mt-2">
            <label id="lpass">Password</label>
            <div id="passbox">

            </div>
            <h4 id="cpass" class="btn btn-success">Ganti Password</h4>
          </div>

          <div class="col-12 mt-2 text-end">
            <button id="simpan" type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
        url: `<?= base_url('/homepage') ?>`,
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
                    <input type="password" class="form-control " id="password" name="password" placeholder="Masukan password baru" required>
                    <p id="msgpass" class="text-danger"></p>
                </div>
                <input type="hidden" id="valpas" value="password">
                <div class="form-group">
                    <label for="kpassword">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="kpassword" placeholder="Masukan Konfirmasi password baru" required>
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

    // edit Profile
    $('#editprofile').submit(function(e) {
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
            url: `<?= base_url() ?>/editProfile`,
            dataType: 'json',
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            data: postdata,
            beforeSend: function() {
              load.show();
            },
            success: (respond) => {

              getData();
              dataProfile();
            },

          })
        }
      } else {
        $.ajax({
          url: `<?= base_url() ?>/editProfile`,
          dataType: 'json',
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
              dataProfile();
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