<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header bg-secondary">
        <h3 class="card-title">Detail Surat</h3>
      </div>
      <!-- /.card-header -->

      <div class="card-body">
        <label for="">Nomor Surat</label>
        <p><?= $surat['nomor_surat'] ?></p>
        <hr>
        <label for="">Judul Surat</label>
        <p><?= $surat['judul_surat'] ?></p>
        <hr>
        <label for="">Jenis Surat</label>
        <p><?= $surat['jenis_surat'] ?></p>
        <hr>

        <label for="">File Surat</label>
        <div class="col-12">
          <?php $files = explode('.', $surat['file']) ?>
          <?php if ($files[1] == 'pdf') : ?>
            <a style="width:30%;" href="<?= base_url('/data/surat/' . $surat['file']) ?>" class="btn btn-outline-danger fw-bold">PDF</a>
          <?php elseif ($files[1] == 'xls' or $files[1] == 'xlsx') : ?>
            <a style="width:30%;" href="<?= base_url('/data/surat/' . $surat['file']) ?>" class="btn btn-outline-success fw-bold">EXCEL</a>
          <?php elseif ($files[1] == 'doc' or $files[1] == 'docx') : ?>
            <a style="width:30%;" href="<?= base_url('/data/surat/' . $surat['file']) ?>" class="btn btn-outline-primary fw-bold">WORD</a>
          <?php endif; ?>
        </div>
        <div class="col-12 d-flex justify-content-between mt-3 border-top">
          <?php
          $time = explode(' ', $surat['created_at']);
          $date = explode('-', $time[0]);
          ?>
          <small class="m-2 mt-3"><span class="description">Dibuat - <?= $date[2] . '-' . $date[1] . '-' . $date[0] . ' | ' . $time[1] ?></span></small>
          <h4 id="batal" class="btn btn-primary ms-2 mt-2 ">Kembali</h4>
        </div>

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
        url: `<?= (session()->get('mastersurat')) ? base_url('/surat') : base_url('/apiSurat') ?>`,
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
    // Batal 
    $('#batal').click(() => {
      getData();
    })




  })
</script>