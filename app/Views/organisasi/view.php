<?= $this->include('layout/sweetalert') ?>
<?php $organisasi = $organisasi[0] ?>
<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" style="max-height:150px;" src="<?= base_url('/data/organisasi/logo/' . $organisasi['logo']) ?>" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?= $organisasi['nama_organisasi'] ?></h3>

                <p class="text-muted text-center fw-bold"><?= $organisasi['singkatan']; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item secondary text-center">
                        <p>Angkatan Periode Sekarang :</p>
                        <p><?= $organisasi['angkatan']; ?></p>
                    </li>
                </ul>

                <button id="edit" data-id="<?= $organisasi['id_organisasi']; ?>" class="btn btn-primary btn-block"><b>Edit Organisasi</b></button>
                <button onclick="konfirmasiPermanent('deleteOrganisasi/<?= $organisasi['id_organisasi']; ?>/organisasi')" data-id="<?= $organisasi['id_organisasi']; ?>" class="btn btn-danger btn-block fw-bold ">Hapus Organisasi</button>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">

                    <li class="nav-item"><a class="nav-link active" href="#tentang" data-toggle="tab">Tentang Organisasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#sejarah" data-toggle="tab">Sejarah</a></li>
                    <li class="nav-item"><a class="nav-link" href="#admin" data-toggle="tab">Pengaturan Admin</a></li>
                    <li class="nav-item"><a class="nav-link" href="#web" data-toggle="tab">Pengaturan Website</a></li>

                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="tentang">
                        <!-- tentang -->
                        <div class="col-12">
                            <h4 class="fw-bold text-center"><span style="border-bottom:solid 2px #007bff">Tentang Organisasi</span></h4>
                        </div>

                        <div>
                            <?= nl2br($organisasi['tentang']); ?>
                        </div>
                        <h4 class="fw-bold text-center mt-3"><span style="border-bottom:solid 2px #007bff">Visi & Misi</span></h4>
                        <div>
                            <?= nl2br($organisasi['visi_misi']); ?>
                        </div>
                        <h4 class="fw-bold text-center mt-3"><span style="border-bottom:solid 2px #007bff">Struktur Organisasi</span></h4>
                        <div class="text-center w-100">
                            <img src="<?= base_url('/data/organisasi/struktur/' . $organisasi['struktur']) ?>" width="80%" alt="">
                        </div>
                    </div>
                    <div class="tab-pane" id="sejarah">
                        <!-- sejarah -->
                        <h4 class="fw-bold text-center"><span style="border-bottom:solid 2px #007bff">Sejarah</span></h4>
                        <div>
                            <?= nl2br($organisasi['sejarah']); ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="admin">
                        <!-- admin -->
                        <h4 class="fw-bold text-center"><span style="border-bottom:solid 2px #007bff">Pengaturan Admin</span></h4>
                        <form id="editadmin">
                            <div class="form-group">
                                <div class="token">
                                    <?= csrf_field() ?>
                                </div>
                                <label for="nama">Admin</label>
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan Nama Admin" value="<?= $admin['nama']; ?>" required>
                            </div>
                            <div class="col-12 mt-2">
                                <label id="lpass">Password</label>
                                <div id="passbox">

                                </div>
                                <h4 id="cpass" class="btn btn-success">Ganti Password</h4>
                            </div>
                            <div class="col-12 mt-2">
                                <label id="lpin">Pin</label>
                                <div id="pinbox">

                                </div>
                                <h4 id="cpin" class="btn btn-success">Ganti Pin</h4>
                            </div>
                            <div class="col-12 mt-2 text-end">
                                <button id="simpan" type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>


                        </form>
                    </div>
                    <div class="tab-pane" id="web">
                        <!-- admin -->
                        <form id="<?= count($web) > 0 ? 'editweb' : 'addweb' ?>">
                            <h4 class="fw-bold text-center"><span style="border-bottom:solid 2px #007bff">Pengaturan Website</span></h4>

                            <div class="token">
                                <?= csrf_field() ?>
                            </div>
                            <?php if (count($web) > 0) : ?>
                                <input type="hidden" name="id_web" value="<?= $web['id_web'] ?>">
                            <?php endif; ?>
                            <div class="col-12">
                                <label>Pilih Template Website</label>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <select class="custom-select" name="template">
                                        <?php
                                        $temp = ['Basic', 'Template1', 'Template2', 'Template3'];
                                        ?>
                                        <?php if (count($web) > 0) : ?>
                                            <option value="<?= $web['template'] ?>"><?= $web['template'] ?></option>
                                            <?php foreach ($temp as $data) : ?>
                                                <?php if ($data != $web['template']) : ?>
                                                    <option value="<?= $data; ?>"><?= $data; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <?php foreach ($temp as $dt) : ?>
                                                <option value="<?= $dt; ?>"><?= $dt; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- radio -->
                                <div class="form-group clearfix">
                                    <label>Pilih Warna Utama Template</label><br>
                                    <div class="icheck-success d-inline">
                                        <input value="success" type="radio" id="radioSuccess1" name="color" checked>
                                        <label for="radioSuccess1" class="p-2 bg-success text-white rounded-pill ms-2 ">
                                            Green
                                        </label>
                                    </div><br>
                                    <div class="icheck-primary d-inline">
                                        <input value="primary" type="radio" id="radioprimary2" name="color">
                                        <label for="radioprimary2" class="p-2 bg-primary text-white rounded-pill ms-2">
                                            Blue
                                        </label>
                                    </div><br>

                                    <div class="icheck-danger d-inline">
                                        <input value="danger" type="radio" id="radiodanger3" name="color">
                                        <label for="radiodanger3" class="p-2 bg-danger text-white rounded-pill ms-2">
                                            Red
                                        </label>
                                    </div><br>
                                    <div class="icheck-warning d-inline">
                                        <input value="warning" type="radio" id="radiowarning3" name="color">
                                        <label for="radiowarning3" class="p-2 bg-warning text-white rounded-pill ms-2">
                                            Orange
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- radio -->
                                <div class="form-group clearfix">
                                    <label>Pilih Jenis Tulisan</label><br>
                                    <div class="icheck-dark d-inline">
                                        <input value="font1" type="radio" id="radiodark1" name="font" checked>
                                        <label for="radiodark1" class="font1 p-2 text-dark rounded-pill ms-2">
                                            Font 1
                                        </label>
                                    </div><br>
                                    <div class="icheck-dark d-inline">
                                        <input value="font2" type="radio" id="radiodark1" name="font">
                                        <label for="radiodark1" class="font2 p-2 text-dark rounded-pill ms-2">
                                            Font 2
                                        </label>
                                    </div><br>
                                    <div class="icheck-dark d-inline">
                                        <input value="font3" type="radio" id="radiodark1" name="font">
                                        <label for="radiodark1" class="font3 p-2 text-dark rounded-pill ms-2">
                                            Font 3
                                        </label>
                                    </div><br>

                                </div>
                            </div>

                            <h3>Gambar Untuk slide show Website</h3>
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-info"></i> Harap dibaca!</h5>
                                <ul>
                                    <li>Gambar slide show digunakan untuk tampilan website organisasi</li>
                                    <li>Gambar slide show harus di isi minimal sampai slide 3</li>
                                </ul>
                            </div>
                            <div class="mb-3">
                                <label for="slide1" class="form-label">Upload Gambar untuk slide1 </label>
                                <input class="form-control " type="file" id="slide1" name="slide1" <?= count($web) > 0 ? '' : 'required' ?>>
                                <p id="msgslide1" class="text-danger"></p>
                            </div>
                            <div class="mb-3">
                                <label for="slide2" class="form-label">Upload Gambar untuk slide2 </label>
                                <input class="form-control " type="file" id="slide2" name="slide2" <?= count($web) > 0 ? '' : 'required' ?>>
                                <p id="msgslide2" class="text-danger"></p>
                            </div>
                            <div class="mb-3">
                                <label for="slide3" class="form-label">Upload Gambar untuk slide3 </label>
                                <input class="form-control " type="file" id="slide3" name="slide3" <?= count($web) > 0 ? '' : 'required' ?>>
                                <p id="msgslide3" class="text-danger"></p>
                            </div>
                            <div class="mb-4">
                                <label for="slide4" class="form-label">Upload Gambar untuk slide4 </label>
                                <input class="form-control " type="file" id="slide4" name="slide4">
                                <p id="msgslide4" class="text-danger"></p>
                            </div>
                            <div class="mb-3">
                                <label for="slide5" class="form-label">Upload Gambar untuk slide5 </label>
                                <input class="form-control " type="file" id="slide5" name="slide5">
                                <p id="msgslide5" class="text-danger"></p>
                            </div>
                            <h3>Gambar Untuk slide show Website</h3>
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-info"></i> Harap dibaca!</h5>
                                <ul>
                                    <li>Gambar Background Login digunakan untuk tampilan Login Page</li>
                                    <li>Gambar harus beresolusi tinggi</li>

                                </ul>
                            </div>
                            <div class="mb-3">
                                <label for="bglogin" class="form-label">Upload Background Login (Resolusi Tinggi)</label>
                                <input class="form-control " type="file" id="bglogin" name="bglogin">
                                <p id="msgbglogin" class="text-danger"></p>
                                <p></p>
                            </div>
                            <div class="col-12 mt-2 text-end">
                                <button id="simpan" type="submit" class="btn btn-primary">Simpan</button>
                            </div>


                        </form>
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
                },
            });
        }
        $(`#edit`).click(function() {
            $.ajax({
                url: `<?= base_url('/organisasi/' . $organisasi['id_organisasi']) ?>`,
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

        //Ganti Pin 
        $('#cpin').click(() => {
            $('#pinbox').html(`
                <div class="form-group">
                <input type="hidden" id="valpin" value="pin">
                    <label for="pin">Pin</label>
                    <input type="password" class="form-control " id="pin" name="pin" placeholder="Masukan pin baru" required>
                    <p id="msgpin" class="text-danger"></p>
                </div>
                <input type="hidden" id="valpin" value="pin">
                <div class="form-group">
                    <label for="kpin">Konfirmasi Pin</label>
                    <input type="password" class="form-control" id="kpin" placeholder="Masukan Konfirmasi pin baru" required>
                    <p id="msgkpin" class="text-danger"></p>
                </div>
                <h4 id="bpin" class="btn btn-danger">Batal</h4>
                `)
            $('#cpin').addClass('d-none')
            $('#lpin').addClass('d-none')
            $('#bpin').click(() => {
                $('#cpin').removeClass('d-none')
                $('#pinbox').html('')
                $('#lpin').removeClass('d-none')
            })

        })
        // edit Admin
        $('#editadmin').submit(function(e) {
            e.preventDefault()
            let postdata = new FormData(this);
            let validasipass = false;
            let pas1 = false
            let pas2 = false
            let validasipin = false;
            let pin1 = false
            let pin2 = false

            if ($('#valpass').val() == 'password') {
                // validasi form
                let pass = $('#password').val();
                let kpass = $('#kpassword').val();
                pas1 = pass.length < 8
                pas2 = pass != kpass
                // validasi form
                validasipass = true;

            }
            if ($('#valpin').val() == 'pin') {
                // validasi form
                let pin = $('#pin').val();
                let kpin = $('#kpin').val();
                pin1 = pin.length < 8
                pin2 = pin != kpin
                // validasi form
                validasipin = true;

            }

            if (validasipass == true && validasipin == true) {
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
                if (pin1) {
                    $('#pin').addClass('is-invalid');
                    $('#msgpin').html('pin harus lebih dari 8 kombinasi huruf dan angka')
                } else {
                    $('#pin').removeClass('is-invalid');
                    $('#msgpin').html('')
                }
                if (pin2) {
                    $('#kpin').addClass('is-invalid');
                    $('#msgkpin').html('Konfirmasi pin harus sama dengan pin')
                } else {
                    $('#kpin').removeClass('is-invalid');
                    $('#msgkpin').html('')
                }

                if (pas1 == false && pas2 == false && pin1 == false && pin2 == false) {
                    $.ajax({
                        url: `<?= base_url() ?>/editAdmin`,
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
                            getData();
                            dataBerhasilAplikasi();
                        },

                    })
                }
            } else if (validasipass == true) {
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
                        url: `<?= base_url() ?>/editAdmin`,
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
                            getData();
                            dataBerhasilAplikasi();
                        },

                    })
                }
            } else if (validasipin == true) {
                if (pin1) {
                    $('#pin').addClass('is-invalid');
                    $('#msgpin').html('pin harus lebih dari 8 kombinasi huruf dan angka')
                } else {
                    $('#pin').removeClass('is-invalid');
                    $('#msgpin').html('')
                }
                if (pin2) {
                    $('#kpin').addClass('is-invalid');
                    $('#msgkpin').html('Konfirmasi pin harus sama dengan pin')
                } else {
                    $('#kpin').removeClass('is-invalid');
                    $('#msgkpin').html('')
                }

                if (pin1 == false && pin2 == false) {
                    $.ajax({
                        url: `<?= base_url() ?>/editAdmin`,
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
                            getData();
                            dataBerhasilAplikasi();

                        },

                    })
                }
            } else {
                $.ajax({
                    url: `<?= base_url() ?>/web`,
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
                        getData();
                        dataBerhasilAplikasi();

                    },

                })
            }




        })

        // website form
        // add website
        $('#addweb').submit(function(e) {
            e.preventDefault()
            let postdata = new FormData(this);

            $.ajax({
                url: `<?= base_url() ?>/web`,
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
                        if (respond.messages.bglogin != "") {
                            $('bglogin').addClass('is-invalid')
                            $('#msgbglogin').html(respond.messages.bglogin)
                        } else {
                            $('bglogin').removeClass('is-invalid')
                            $('#msgbglogin').html('')
                        }
                        if (respond.messages.slide1 != "") {
                            $('#slide1').addClass('is-invalid')
                            $('#msgslide1').html(respond.messages.slide1)
                        } else {
                            $('#slide1').removeClass('is-invalid')
                            $('#msgslide1').html('')
                        }
                        if (respond.messages.slide2 != "") {
                            $('#slide2').addClass('is-invalid')
                            $('#msgslide2').html(respond.messages.slide2)
                        } else {
                            $('#slide2').removeClass('is-invalid')
                            $('#msgslide2').html('')
                        }
                        if (respond.messages.slide3 != "") {
                            $('#slide3').addClass('is-invalid')
                            $('#msgslide3').html(respond.messages.slide3)
                        } else {
                            $('#slide3').removeClass('is-invalid')
                            $('#msgslide3').html('')
                        }
                        if (respond.messages.slide4 != "") {
                            $('#slide4').addClass('is-invalid')
                            $('#msgslide4').html(respond.messages.slide4)
                        } else {
                            $('#slide4').removeClass('is-invalid')
                            $('#msgslide4').html('')
                        }
                        if (respond.messages.slide5 != "") {
                            $('#slide5').addClass('is-invalid')
                            $('#msgslide5').html(respond.messages.slide5)
                        } else {
                            $('#slide5').removeClass('is-invalid')
                            $('#msgslide5').html('')
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
        // edit website
        $('#editweb').submit(function(e) {
            e.preventDefault()
            let postdata = new FormData(this);

            $.ajax({
                url: `<?= base_url() ?>/editWeb`,
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
                        if (respond.messages.bglogin != "") {
                            $('bglogin').addClass('is-invalid')
                            $('#msgbglogin').html(respond.messages.bglogin)
                        } else {
                            $('bglogin').removeClass('is-invalid')
                            $('#msgbglogin').html('')
                        }
                        if (respond.messages.slide1 != "") {
                            $('#slide1').addClass('is-invalid')
                            $('#msgslide1').html(respond.messages.slide1)
                        } else {
                            $('#slide1').removeClass('is-invalid')
                            $('#msgslide1').html('')
                        }
                        if (respond.messages.slide2 != "") {
                            $('#slide2').addClass('is-invalid')
                            $('#msgslide2').html(respond.messages.slide2)
                        } else {
                            $('#slide2').removeClass('is-invalid')
                            $('#msgslide2').html('')
                        }
                        if (respond.messages.slide3 != "") {
                            $('#slide3').addClass('is-invalid')
                            $('#msgslide3').html(respond.messages.slide3)
                        } else {
                            $('#slide3').removeClass('is-invalid')
                            $('#msgslide3').html('')
                        }
                        if (respond.messages.slide4 != "") {
                            $('#slide4').addClass('is-invalid')
                            $('#msgslide4').html(respond.messages.slide4)
                        } else {
                            $('#slide4').removeClass('is-invalid')
                            $('#msgslide4').html('')
                        }
                        if (respond.messages.slide5 != "") {
                            $('#slide5').addClass('is-invalid')
                            $('#msgslide5').html(respond.messages.slide5)
                        } else {
                            $('#slide5').removeClass('is-invalid')
                            $('#msgslide5').html('')
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
    })
</script>