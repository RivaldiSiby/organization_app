<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header bg-secondary">
        <h3 class="card-title">Edit Moderator</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form id="add">
          <?= csrf_field() ?>
          <div class="form-group">
            <label for="nama_moderator">Nama Moderator</label>
            <input type="text" class="form-control" id="nama_moderator" name="nama_moderator" placeholder="Nama Moderator" value="<?= $moderator['nama_moderator']; ?>" required>
          </div>
          <?php $rules = [
            0 => [
              'moderator' => "Mengatur Arsip Surat",
              'key' => "0"
            ],
            1 => [
              'moderator' => "Mengatur Master Member",
              'key' => "1"
            ],
            2 => [
              'moderator' => "Mengatur Postingan",
              'key' => "2"
            ],
            3 => [
              'moderator' => "Mengatur Arsip Laporan Keuangan",
              'key' => "3"
            ],
            4 => [
              'moderator' => "Mengatur Bidang Organisasi",
              'key' => "4"
            ],
            5 => [
              'moderator' => "Mengatur Jabatan Organisasi",
              'key' => "5"
            ],
            6 => [
              'moderator' => "Mengatur Kegiatan Organisasi",
              'key' => "6"
            ],
            7 => [
              'moderator' => "Melihat Data Organisasi",
              'key' => "7"
            ],


          ] ?>
          <div class="row">
            <div class="col-12">
              <label>Pilih Rules Fitur Moderator </label>
            </div>
            <div class="col-sm-10">
              <div class="form-group">
                <select id="datafitur" class="custom-select">
                  <?php foreach ($rules as $data) : ?>
                    <option value="<?= $data['moderator']; ?>"><?= $data['moderator']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <h4 id="tambahfitur" class="btn d-none btn-dark me-2">Tambah</h4>
              <h4 id="reset" class="btn btn-danger">Reset</h4>
            </div>
          </div>
          <label>Fitur Yang dipilih </label>
          <div id="listfitur">
            <?php $list = explode(',', $moderator['rules']) ?>
            <?php foreach ($list as $li) : ?>
              <div class="callout callout-info">
                <h5><?= $li; ?></h5>
              </div>
            <?php endforeach; ?>
          </div>
          <p id="msg" class="fw-bold text-danger"></p>
          <input type="text" class="d-none" id="rules" name="rules" value="<?= $moderator['rules']; ?>">
          <input type="hidden" id="id" name="id" value="<?= $moderator['id_moderator']; ?>">
          <button id="simpan" class="btn btn-primary">Simpan Perubahan</button>
          <h4 id="batal" class="btn btn-danger ms-2 mt-2">Batal</h4>
        </form>
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
        url: `<?= base_url('/moderator') ?>`,
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
    // tambah fitur
    let fitur = [];
    $("#tambahfitur").click(() => {
      const valfitur = $("#datafitur").val();
      if (fitur.length > 0) {
        let cek = false
        fitur.forEach((e) => {
          if (e == valfitur) {
            cek = true
          }
        })
        if (cek == false) {
          fitur.push(valfitur);
        }
      } else {
        fitur.push(valfitur);
      }
      $("#listfitur").html("");
      fitur.forEach((e) => {
        $("#listfitur").append(`
        <div class="callout callout-info">
            <h5>${e}</h5>
          </div>
    `);
        // masukan data yang dipilih
        $("#rules").val(fitur);
      });
    });

    // riset fitur
    $("#reset").click(() => {
      fitur = []
      $("#listfitur").html(`
      <p>Belum ada fitur yang dipilih</p>
      `);
      $("#rules").val("");
      $("#tambahfitur").removeClass('d-none')
    })
    // edit fitur 
    $('#add').submit(function(e) {
      let rule = $('#rules').val();
      let idmoder = $('#id').val();
      let editData = new FormData(this)

      e.preventDefault()
      if (rule == "") {
        $('#msg').html("Fitur Harus dipilih dan tidak boleh kosong")
      } else {
        $.ajax({
          url: `<?= base_url() ?>/editModerator`,
          dataType: 'json',
          type: "POST",
          processData: false,
          contentType: false,
          cache: false,
          data: editData,
          beforeSend: function() {
            load.show();
          },
          success: (respond) => {
            getData();
            dataUbah();
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