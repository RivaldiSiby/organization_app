<?php $organisasi = $organisasi[0] ?>
<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header bg-secondary">
        <h3 class="card-title">Pengaturan Aplikasi</h3>
      </div>
      <!-- /.card-header -->

      <div class="card-body">
        <div class="form-group">
          <label for="nama_organisasi">Nama Organisasi</label>
          <input type="text" class="form-control" id="nama_organisasi" name="nama_organisasi" placeholder="Masukan Nama Organisasi" value="<?= $organisasi['nama_organisasi']; ?>" required>
        </div>
        <div class="form-group">
          <label for="singkatan">Singkatan Organisasi</label>
          <input type="text" class="form-control" id="singkatan" name="singkatan" placeholder="Masukan Singkatan Organisasi" value="<?= $organisasi['singkatan']; ?>" required>
        </div>
        <div class="form-group">
          <label for="visi_misi">Visi dan Misi Organisasi</label>
          <textarea class="form-control" id="editor" name="visi_misi" rows="3" required><?= $organisasi['visi_misi']; ?></textarea>
        </div>
        <form id="add">
          <div class="token">
            <?= csrf_field() ?>
          </div>
          <input type="hidden" name="id_organisasi" value="<?= $organisasi['id_organisasi']; ?>">
          <div class="form-group">
            <label for="sejarah">Sejarah Organisasi</label>
            <textarea class="form-control" name="sejarah" rows="3" placeholder="Masukan Sejarah Organisasi" required><?= $organisasi['sejarah']; ?></textarea>
          </div>
          <div class="form-group">
            <label for="tentang">Tentang Organisasi</label>
            <textarea id="tentang" class="form-control" name="tentang" rows="3" placeholder="Masukan Tentang Organisasi" required><?= $organisasi['tentang']; ?></textarea>
          </div>
          <div class="form-group">
            <label for="angkatan">Angkatan Organisasi (Periode Sekarang)</label>
            <input type="text" class="form-control" id="angkatan" name="angkatan" placeholder="Masukan Angkatan Organisasi pada periode sekarang" value="<?= $organisasi['angkatan']; ?>" required>
          </div>
          <h3>Kontak Organisasi</h3>
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i> Harap dibaca!</h5>
            <ul>
              <li>Silahkan Memasukan Kontak Organisasi</li>
              <li>Jika tidak ada salah satu dari kontak yang tertara tidak perlu disi</li>
            </ul>
          </div>
          <div class="form-group">
            <label for="wa">Nomor WA</label>
            <input type="text" class="form-control" id="wa" name="wa" placeholder="Masukan wa Organisasi " value="<?= $organisasi['wa']; ?>">
          </div>
          <div class="form-group">
            <label for="fb">Facebook</label>
            <input type="text" class="form-control" id="fb" name="fb" placeholder="Masukan facebook Organisasi " value="<?= $organisasi['fb']; ?>">
          </div>
          <div class="form-group">
            <label for="ig">Instagram</label>
            <input type="text" class="form-control" id="ig" name="ig" placeholder="Masukan Instagram Organisasi " value="<?= $organisasi['ig']; ?>">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Email Organisasi " value="<?= $organisasi['email']; ?>">
          </div>
          <h3>Moderator Utama (Akan Tampil Diwebsite)</h3>
          <div class="row">
            <div class="col-12">
              <label>Pilih Moderator Utama (Maksimal 3)</label>
            </div>
            <div class="col-sm-10">
              <div class="form-group">
                <select id="datamode" class="custom-select">
                  <?php foreach ($moderator as $data) : ?>
                    <option value="<?= $data['nama_moderator']; ?>"><?= $data['nama_moderator']; ?></option>
                  <?php endforeach; ?>
                </select>
                <?php if (count($moderator) > 1) : ?>
                  <small>Sebelum memasukan moderator utama, silahkan membuat moderator terlebih dahulu</small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-2">
              <h4 id="tambahmode" class="btn btn-dark me-2">Tambah</h4>
              <h4 id="reset" class="btn btn-danger">Reset</h4>
            </div>
          </div>
          <label>Moderator Yang dipilih </label>
          <div id="listmode">
            <?php $list = explode(',', $organisasi['moderator_utama']) ?>
            <?php foreach ($list as $li) : ?>
              <div class="callout callout-info">
                <h5><?= $li; ?></h5>
              </div>
            <?php endforeach; ?>
          </div>
          <p id="msg" class="fw-bold text-danger"></p>
          <input type="text" class="d-none" id="moderator_utama" name="moderator_utama" value="<?= $organisasi['moderator_utama']; ?>">

          <h3>Gambar Untuk Organisasi</h3>
          <div class="mb-3">
            <label for="struktur" class="form-label">Upload Gambar Baru Struktur Organisasi</label>
            <input class="form-control " type="file" id="struktur" name="struktur">
            <p id="msgstruktur" class="text-danger"></p>
          </div>
          <div class="mb-3">
            <label for="logo" class="form-label">Upload Logo Baru Organisasi</label>
            <input class="form-control " type="file" id="logo" name="logo">
            <p id="msglogo" class="text-danger"></p>
          </div>
          <button id="simpan" type="submit" class="btn btn-primary">Simpan Perubahan Konfigurasi</button>
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
        url: `<?= base_url('/organisasi') ?>`,
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

    // tambah moderator
    let moderator = [];
    $("#tambahmode").click(() => {
      const valmode = $("#datamode").val();
      if (moderator.length > 0) {
        let cek = false
        moderator.forEach((e) => {
          if (e == valmode) {
            cek = true
          }
        })
        if (moderator.length >= 3) {
          cek = true
        }
        if (cek == false) {
          moderator.push(valmode);
        }
      } else {
        moderator.push(valmode);
      }
      $("#listmode").html("");
      moderator.forEach((e) => {
        $("#listmode").append(`
        <div class="callout callout-info">
            <h5>${e}</h5>
          </div>
    `);
        // masukan data yang dipilih
        $("#moderator_utama").val(moderator);
      });
    });

    // riset moderator
    $("#reset").click(() => {
      moderator = []
      $("#listmode").html(`
      <p>Belum ada moderator yang dipilih</p>
      `);
      $("#moderator_utama").val("");
    })

    // edit Organisasi
    $('#add').submit(function(e) {
      e.preventDefault()
      let visimisi = $('.ck-content').html()
      let namaorganisasi = $('#nama_organisasi').val()
      let singkatan = $('#singkatan').val()
      let postdata = new FormData(this);

      // menambahkan data
      postdata.append('visi_misi', visimisi)
      postdata.append('nama_organisasi', namaorganisasi)
      postdata.append('singkatan', singkatan)


      $.ajax({
        url: `<?= base_url() ?>/editOrganisasi`,
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
            if (respond.messages.struktur != "") {
              $('#struktur').addClass('is-invalid')
              $('#msgstruktur').html(respond.messages.struktur)
            } else {
              $('#struktur').removeClass('is-invalid')
              $('#msgstruktur').html('')
            }
            if (respond.messages.logo != "") {
              $('#logo').addClass('is-invalid')
              $('#msglogo').html(respond.messages.logo)
            } else {
              $('#logo').removeClass('is-invalid')
              $('#msglogo').html('')
            }

            $(".token").html(respond.token);
            load.hide();
          } else if (respond.error == null) {
            getData();
            dataBerhasilAplikasi();
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