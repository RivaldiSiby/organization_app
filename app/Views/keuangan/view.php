<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header bg-secondary">
        <h3 class="card-title">Detail Laporan Keuangan</h3>
      </div>
      <!-- /.card-header -->

      <div class="card-body">
        <label for="">Nomor Laporan Keuangan</label>
        <p><?= $keuangan['nomor_laporan'] ?></p>
        <hr>
        <label for="">Judul Laporan Keuangan</label>
        <p><?= $keuangan['judul_laporan'] ?></p>
        <hr>

        <label for="">File laporan</label>
        <div class="col-12">
          <?php $files = explode('.', $keuangan['file']) ?>
          <?php if ($files[1] == 'pdf') : ?>
            <a style="width:30%;" href="<?= base_url('/data/keuangan/' . $keuangan['file']) ?>" class="btn btn-outline-danger fw-bold">PDF</a>
          <?php elseif ($files[1] == 'xls' or $files[1] == 'xlsx') : ?>
            <a style="width:30%;" href="<?= base_url('/data/keuangan/' . $keuangan['file']) ?>" class="btn btn-outline-success fw-bold">EXCEL</a>
          <?php elseif ($files[1] == 'doc' or $files[1] == 'docx') : ?>
            <a style="width:30%;" href="<?= base_url('/data/keuangan/' . $keuangan['file']) ?>" class="btn btn-outline-primary fw-bold">WORD</a>
          <?php endif; ?>
        </div>
        <div class="col-12 d-flex justify-content-between mt-3 border-top">
          <?php
          $time = explode(' ', $keuangan['created_at']);
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
    load.hide();
    let list = $("#listpage");
    // tarik data
    function getData() {
      $.ajax({
        url: `<?= (session()->get('masterkeuangan')) ? base_url('/keuangan') : base_url('/apiKeuangan') ?>`,
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