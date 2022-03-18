<img width="100px" class="mx-auto" height="100px" id="load" style="position: absolute;z-index:100; left:45%;top:30%;" src="<?= base_url('/img/load.gif') ?>" alt="" srcset="">
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header bg-secondary">
        <h3 class="card-title">Atur Jabatan Member</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form id="add">
          <?= csrf_field() ?>
          <div class="form-group">
            <label for="jabatan">Jabatan Member</label>
            <select id="jabatan" name="jabatan" class="custom-select" required>
              <option value="<?= $member['jabatan']; ?>" selected><?= $member['jabatan']; ?></option>
              <?php foreach ($moderator as $data) : ?>
                <?php if ($data['nama_moderator'] != $member['jabatan']) : ?>
                  <option value="<?= $data['nama_moderator']; ?>"><?= $data['nama_moderator']; ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
              <?php foreach ($bidang as $data) : ?>
                <?php if ($data['bidang'] != $member['jabatan']) : ?>
                  <option value="<?= $data['bidang']; ?>">Bidang <?= $data['bidang']; ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
              <?php if ($member['jabatan'] != 'Member') : ?>
                <option value="Member">Member</option>
              <?php endif; ?>

            </select>
          </div>
          <input type="hidden" id="id" name="id" value="<?= $member['id_member']; ?>">
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
        url: `<?= (session()->get('mastermember')) ? base_url('/member') : base_url('/apiMember') ?>`,
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
        url: `<?= base_url() ?>/position`,
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
          dataPosition(respond.messages.success);
        },
      })

    })
    // Batal 
    $('#batal').click(() => {
      getData();
    })




  })
</script>