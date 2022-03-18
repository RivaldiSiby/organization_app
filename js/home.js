$(document).ready(() => {
  let app = $("#app");
  const baseurl = $("#baseurl").val();
  let load = $("#load");

  load.hide();

  function getData(url) {
    $.ajax({
      url: `${url}`,
      dataType: "html",
      type: "GET",
      beforeSend: function () {
        load.show();
      },
      success: (respond) => {
        load.hide();
        app.html(`${respond}`);
      },
    });
  }
  function menu(menu) {
    $(".nav-link").removeClass("border-bottom");
    $(".nav-link").removeClass("border-2");
    $(menu).addClass("border-bottom border-2");
  }

  $("#home").click(() => {
    getData(`${baseurl}/homeview`);
    menu("#home");
  });
  $("#post").click(() => {
    getData(`${baseurl}/postview`);
    menu("#post");
  });
  $("#postview").click(() => {
    getData(`${baseurl}/postview`);
    menu("#post");
  });
  $("#program").click(() => {
    getData(`${baseurl}/programview`);
    menu("#program");
  });
  $("#sejarah").click(() => {
    getData(`${baseurl}/historyview`);
    menu("#sejarah");
  });
  $("#struktur").click(() => {
    getData(`${baseurl}/strukturview`);
    menu("#struktur");
  });
  $("#tentang").click(() => {
    getData(`${baseurl}/aboutview`);
    menu("#tentang");
  });
});
