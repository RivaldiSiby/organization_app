<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <?php if ($member['foto'] != '') : ?>
                        <img class="profile-user-img img-fluid img-circle" style="max-height:150px;" src="<?= base_url('/data/member/img/' . $member['foto']) ?>" alt="User profile picture">
                    <?php else : ?>
                        <img class="profile-user-img img-fluid img-circle" style="max-height:150px;" src="<?= base_url('/img/profile.png') ?>" alt="User profile picture">
                    <?php endif; ?>
                </div>

                <h3 class="profile-username text-center"><?= $member['nama'] ?></h3>

                <p class="text-muted text-center fw-bold"><?= $member['jabatan']; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item secondary text-center">
                        <b><?= $member['jenis_kelamin']; ?></b>
                    </li>
                </ul>
                <?php if (session()->get('mastermember')) : ?>
                    <button id="edit" data-id="<?= $member['id_member']; ?>" class="btn btn-warning btn-block"><b>Edit</b></button>
                <?php endif; ?>
                <?php if (session()->get('level') == 'member') : ?>
                    <button id="pengaturan" data-ids="<?= $member['id_member']; ?>" class="btn btn-primary btn-block"><b>Pengaturan Profile</b></button>
                <?php endif; ?>
                <?php if (session()->get('jabatan') != 'Member') : ?>
                    <button id="member" class=" btn btn-danger btn-block"><b>Kembali</b></button>
                <?php endif; ?>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <h4 class="fw-bold">Profile Member</h4>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <!-- /.tab-pane -->
                    <div class="tab-pane active" id="settings">
                        <div class="form-group row border-bottom">
                            <label for="inputName" class="col-sm-12 col-form-label">Tempat Lahir :</label>
                            <div class="col-sm-10 ">
                                <p class="fw-bold"><?= $member['tempat_lahir']; ?></p>
                            </div>
                        </div>
                        <div class="form-group row border-bottom">
                            <label for="inputName" class="col-sm-12 col-form-label">Tanggal Lahir :</label>
                            <div class="col-sm-10 ">
                                <p class="fw-bold"><?= $member['tanggal_lahir']; ?></p>
                            </div>
                        </div>
                        <div class="form-group row border-bottom">
                            <label for="inputName" class="col-sm-12 col-form-label">Angkatan :</label>
                            <div class="col-sm-10 ">
                                <p class="fw-bold"><?= $member['angkatan']; ?></p>
                            </div>
                        </div>
                        <div class="form-group row border-bottom">
                            <label for="inputName" class="col-sm-12 col-form-label">Alamat :</label>
                            <div class="col-sm-10 ">
                                <p class="fw-bold"><?= $member['alamat']; ?></p>
                            </div>
                        </div>
                        <div class="form-group row border-bottom">
                            <label for="inputName" class="col-sm-12 col-form-label">Nomor KTA :</label>
                            <div class="col-sm-10 ">
                                <p class="fw-bold"><?= $member['kta']; ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<script>
    $(document).ready(() => {
        let load = $("#load");
        load.hide();
        let list = $("#listpage");
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
        $('#member').click(() => {
            getData();
        })
        $(`#edit`).click(function() {
            let id = $(this).attr('data-id');
            $.ajax({
                url: `<?= base_url() ?>/memberEdit/${id}`,
                dataType: 'html',
                type: "GET",
                beforeSend: function() {
                    load.show();
                },
                success: (respond) => {
                    $('#root').html(`${respond}`);
                    list.html("edit");
                },
            });
        });
        $(`#pengaturan`).click(function() {
            let ids = $(this).attr('data-ids');
            $.ajax({
                url: `<?= base_url() ?>/memberPengaturan/${ids}`,
                dataType: 'html',
                type: "GET",
                beforeSend: function() {
                    load.show();
                },
                success: (respond) => {
                    $('#root').html(`${respond}`);
                    list.html("Pengaturan");
                },
            });
        });
    })
</script>