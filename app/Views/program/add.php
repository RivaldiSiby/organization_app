<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header bg-secondary">
        <h3 class="card-title">Tambah Program Kerja</h3>
      </div>
      <!-- /.card-header -->

      <div class="card-body">
        <form id="add">
          <div class="form-group">
            <?= csrf_field() ?>
            <label for="program">Program Kerja</label>
            <input type="text" class="form-control" id="program" name="program" placeholder="Masukan Program Kerja" required>
          </div>
          <?php if (session()->get('level') == 'admin') : ?>
            <div class="form-group">
              <label for="bidang">Bidang Organisasi</label>
              <select id="bidang" name="bidang" class="custom-select" required>
                <option value="" selected>--Pilih Bidang Organisasi--</option>
                <?php foreach ($bidang as $data) : ?>
                  <option value="<?= $data['bidang']; ?>"><?= $data['bidang']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          <?php endif; ?>

          <?php if (isset($jabatanbidang)) : ?>
            <input type="hidden" name="bidang" value="<?= $jabatanbidang ?>">
          <?php endif; ?>
          <input type="hidden" name="angkatan" value="<?= session()->get('angkatanapp') ?>">
          <button id="simpan" type="submit" class="btn btn-primary">Simpan</button>
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
        url: `<?= base_url('/program') ?>`,
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

    // add fitur 
    $("#add").submit(function(e) {
      e.preventDefault()
      let postData = new FormData(this)

      $.ajax({
        url: `<?= base_url() ?>/program`,
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
          getData();
          dataBerhasil();
        },
      })

    })
    // Batal 
    $('#batal').click(() => {
      getData();
    })




  })
</script>