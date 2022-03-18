<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header bg-secondary">
        <h3 class="card-title">Edit Bidang Organisasi</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form id="add">
          <?= csrf_field() ?>
          <div class="form-group">
            <label for="bidang">Bidang Organisasi</label>
            <input type="text" maxlength="40" class="form-control" id="bidang" name="bidang" placeholder="Bidang Organisasi" value="<?= $bidang['bidang']; ?>" required>
            <small>Maksimal inputan 40 karakter</small>
          </div>

          <input type="hidden" id="id" name="id" value="<?= $bidang['id_bidang']; ?>">
          <button id="simpan" class="btn btn-primary">Simpan Perubahan</button>
          <h4 id="batal" class="btn btn-danger ms-3 mt-2 ">Batal</h4>
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
        url: `<?= base_url('/bidang') ?>`,
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

    // edit fitur 
    $('#add').submit(function(e) {
      let editData = new FormData(this)

      e.preventDefault()

      $.ajax({
        url: `<?= base_url() ?>/editBidang`,
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

    })
    // Batal 
    $('#batal').click(() => {
      getData();
    })




  })
</script>