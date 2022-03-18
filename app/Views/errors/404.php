<div class="row mb-2">
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-warning"></h2>

            <div class="error-content text-center">
                <h2 style="font-size: 100px;" class="text-center fw-bold text-danger">
                    <i class="fas fa-exclamation-triangle text-danger"></i>404
                </h2>
                <h3> Maaf! Request Anda tidak diijinkan</h3>

                <button id="home" class="btn btn-info fw-bold shadow">Kembail ke Dashboard</button>

            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
    <!-- /.content -->
</div>

<script>
    $(document).ready(() => {
        const baseurl = $("#baseurl").val();
        const approot = $("#root");
        let title = $("#hpage");
        let title2 = $("#hpage2");
        let list = $("#listpage");
        let load = $("#load");

        function menu($menu) {
            $(".nav-link").removeClass("active");
            $($menu).addClass("active");
        }

        function getData(url) {
            $.ajax({
                url: `${url}`,
                dataType: "html",
                type: "GET",
                beforeSend: function() {
                    load.show();
                },
                success: (respond) => {
                    load.hide();
                    approot.html(`${respond}`);
                },
            });
        }
        $('#home').click(() => {
            getData(`${baseurl}/homepage`);
            title.html("Dashboard");
            title2.html("Dashboard");
            list.html("Home");
            menu("#dashboard");
        })
    })
</script>