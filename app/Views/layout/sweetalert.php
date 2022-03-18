<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

</script>
<script>
    <?php if (session()->getFlashdata('login')) : ?>
        // ketika berhasil login
        Swal.fire(
            '<?= session()->getFlashdata('login') ?>',
            'Selamat Datang',
            'success'
        )
        // ketika berhasil login
    <?php endif; ?>
    // Berhasil Memasukan Data 
    function dataBerhasil() {
        Swal.fire(
            'Proses Berhasil',
            'Data Berhasil ditambahkan',
            'success'
        )
    }

    function dataAddGagal() {
        Swal.fire(
            'Proses Gagal',
            'Data Tidak Berhasil ditambahkan',
            'error'
        )
    }

    function dataEditGagal() {
        Swal.fire(
            'Proses Gagal',
            'Data Tidak Berhasil diUbah',
            'error'
        )
    }

    function dataBerhasilUbah(pesan, request) {
        Swal.fire(
            `${request} Berhasil diubah`,
            `${pesan}`,
            'success'
        )
    }

    function dataUbah() {
        Swal.fire(
            'Proses Berhasil',
            'Data Berhasil diubah',
            'success'
        )
    }

    function dataProfile() {
        Swal.fire(
            'Proses Berhasil',
            'Profile Berhasil diPerbaharui, Silahkan Refresh Halaman',
            'success'
        )
    }

    function dataHapus() {
        Swal.fire(
            'Proses Berhasil',
            'Data Berhasil diHapus'
        )
    }

    function dataRestore() {
        Swal.fire(
            'Proses Berhasil',
            'Data Berhasil diPulihkan'
        )
    }

    function dataClear() {
        Swal.fire(
            'Proses Berhasil',
            'Data Backup Berhasil diBersihkan'
        )
    }

    function dataAplikasi() {
        Swal.fire(
            'Proses Berhasil',
            'Aplikasi Berhasil dibuka'
        )
    }

    function dataBerhasilAplikasi() {
        Swal.fire(
            'Proses Berhasil',
            'Silahkan Refresh / Relog Browser untuk memperoleh perubahan'
        )
    }

    function dataPosition(msg) {
        Swal.fire(
            'Proses Berhasil',
            `${msg}`
        )
    }

    function dataGagal(request) {
        Swal.fire(
            `${request} tidak Berhasil diubah`,
            `Konfirmasi Password tidak sesuai`,
            'error'
        )
    }

    // fungsi hapus
    // konfirmasi delete
    function konfirmasiPermanent(link) {
        let string = link;
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data akan dihapus secara permanent",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya,Hapus Permanent'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    "Permintaan sedang diproses"
                )
                let links = string.split("/", 3)
                $(document).ready(() => {
                    function getData() {
                        $.ajax({
                            url: `<?= base_url() ?>/${links[2]}`,
                            dataType: 'html',
                            type: "GET",
                            success: (respond) => {
                                $('#root').html(`${respond}`);
                            },
                        });
                    }
                    $.ajax({
                        url: `<?= base_url() ?>/${links[0]}`,
                        dataType: 'json',
                        method: "POST",
                        data: {
                            tokenseckey: '<?= csrf_hash() ?>',
                            id: links[1]
                        },
                        success: (respond) => {
                            getData();
                            if (links[2] == 'organisasi') {
                                dataBerhasilAplikasi();
                            } else {
                                dataHapus();
                            }
                        },
                    });
                })

            }
        })
    }
    // konfirmasi softdelete
    function konfirmasiDel(link) {
        let string = link;
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya,Hapus Data ini'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    "Permintaan sedang diproses"
                )
                let links = string.split(",", 2)
                $(document).ready(() => {
                    function getData(key) {
                        $.ajax({
                            url: `<?= base_url() ?>/${key}`,
                            dataType: 'html',
                            type: "GET",
                            success: (respond) => {
                                $('#root').html(`${respond}`);
                            },
                        });
                    }
                    $.ajax({
                        url: `<?= base_url() ?>/${links[0]}`,
                        dataType: 'html',
                        type: "GET",
                        success: (respond) => {
                            getData(links[1]);
                            dataHapus();
                        },
                    });
                })

            }
        })
    }
    // konfirmasi Restore
    function konfirmasiRestore(link) {
        let string = link;
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data akan dipulihkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya,Pulihkan Data ini'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    "Permintaan sedang diproses"
                )
                let links = string.split(",", 2)
                $(document).ready(() => {
                    function getData(key) {
                        $.ajax({
                            url: `<?= base_url() ?>/${key}`,
                            dataType: 'html',
                            type: "GET",
                            success: (respond) => {
                                $('#root').html(`${respond}`);
                            },
                        });
                    }
                    $.ajax({
                        url: `<?= base_url() ?>/${links[0]}`,
                        dataType: 'html',
                        type: "GET",
                        success: (respond) => {
                            getData(links[1]);
                            dataRestore();
                        },
                    });
                })

            }
        })
    }

    // konfirmasi Bersihkan data backup
    function konfirmasiClear(link) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data Backup akan dibersihkan ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    "Permintaan sedang diproses"
                )
                let links = link.split("/", 2)
                $(document).ready(() => {
                    function getData(key) {
                        $.ajax({
                            url: `<?= base_url() ?>/${links[1]}`,
                            dataType: 'html',
                            type: "GET",
                            success: (respond) => {
                                $('#root').html(`${respond}`);
                            },
                        });
                    }
                    $.ajax({
                        url: `<?= base_url() ?>/${links[0]}`,
                        dataType: 'html',
                        type: "GET",
                        success: (respond) => {
                            getData(links[1]);
                            dataClear();
                        },
                    });
                })
            }
        })
    }

    // konfirmasi Bersihkan Data Log
    function konfirmasiClearLog(link) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data Log Aktifitas akan dibersihkan ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    "Permintaan sedang diproses"
                )
                let links = link.split("/", 2)
                $(document).ready(() => {
                    function getData(key) {
                        $.ajax({
                            url: `<?= base_url() ?>/${links[1]}`,
                            dataType: 'html',
                            type: "GET",
                            success: (respond) => {
                                $('#root').html(`${respond}`);
                            },
                        });
                    }
                    $.ajax({
                        url: `<?= base_url() ?>/${links[0]}`,
                        dataType: 'html',
                        type: "GET",
                        success: (respond) => {
                            getData(links[1]);
                            dataClear();
                        },
                    });
                })
            }
        })
    }
    // konfirmasi
    function konfirmasiRequest(link) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Request anda akan diproses ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    "Permintaan sedang diproses"
                )
            }
        })
    }
    // konfirmasi
    function konfirmasiLogout(link) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Keluar Dari Akun Anda",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url('/logout') ?>'
                Swal.fire(
                    "Permintaan sedang diproses"
                )
            }
        })
    }
    // konfirmasi
</script>