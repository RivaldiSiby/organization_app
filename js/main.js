$(document).ready(() => {
  // variable
  const baseurl = $("#baseurl").val();
  const approot = $("#root");
  let title = $("#hpage");
  let title2 = $("#hpage2");
  let list = $("#listpage");
  let load = $("#load");

  load.hide();
  // function
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
        approot.html(`${respond}`);
      },
    });
  }
  function menu($menu) {
    $(".nav-link").removeClass("active");
    $($menu).addClass("active");
  }
  //   dashboard
  $("#dashboard").click(() => {
    getData(`${baseurl}/homepage`);
    title.html("Dashboard");
    title2.html("Dashboard");
    list.html("Home");
    menu("#dashboard");
  });

  // profile
  $("#profilemember").click(() => {
    getData(`${baseurl}/member/${$("#idusers").val()}`);
    title.html("Member");
    title2.html("Member");
    list.html("Profile");
  });
  // profile

  //   log
  $("#log").click(() => {
    getData(`${baseurl}/log`);
    title.html("Log Activity");
    title2.html("Log Activity");
    list.html("view");
    menu("#log");
  });

  //   organisasi
  $("#organisasi").click(() => {
    getData(`${baseurl}/organisasi`);
    title.html("Organisasi");
    title2.html("Organisasi");
    list.html("Setting");
    menu("#organisasi");
  });
  //   moderator
  $("#moderator").click(() => {
    getData(`${baseurl}/moderator`);
    title.html("Moderator");
    title2.html("Moderator");
    list.html("view");
    menu("#moderator");
  });
  //   bidang
  $("#bidang").click(() => {
    getData(`${baseurl}/bidang`);
    title.html("Bidang Organisasi");
    title2.html("Bidang Organisasi");
    list.html("view");
    menu("#bidang");
  });
  //   program
  $("#program").click(() => {
    getData(`${baseurl}/program`);
    title.html("Program Kerja");
    title2.html("Program Kerja");
    list.html("view");
    menu("#program");
  });

  // Master data
  // member
  $("#mastermember").click(() => {
    getData(`${baseurl}/member`);
    title.html("Member");
    title2.html("Member");
    list.html("view");
    menu("#master");
  });
  //surat
  $("#mastersurat").click(() => {
    getData(`${baseurl}/surat`);
    title.html("Surat");
    title2.html("Surat");
    list.html("view");
    menu("#master");
  });
  //keuangan
  $("#masterkeuangan").click(() => {
    getData(`${baseurl}/keuangan`);
    title.html("Keuangan");
    title2.html("Keuangan");
    list.html("view");
    menu("#master");
  });
  //postingan
  $("#masterpostingan").click(() => {
    getData(`${baseurl}/postingan`);
    title.html("Postingan");
    title2.html("Postingan");
    list.html("view");
    menu("#master");
  });
  //kegiatan
  $("#masterkegiatan").click(() => {
    getData(`${baseurl}/kegiatan`);
    title.html("Kegiatan");
    title2.html("Kegiatan");
    list.html("view");
    menu("#master");
  });
  // Master Data

  // Backup data
  // member
  $("#backupmember").click(() => {
    getData(`${baseurl}/backupMember`);
    title.html("Member");
    title2.html("Member");
    list.html("view");
    menu("#backup");
  });
  //surat
  $("#backupsurat").click(() => {
    getData(`${baseurl}/backupSurat`);
    title.html("Surat");
    title2.html("Surat");
    list.html("view");
    menu("#backup");
  });
  //keuangan
  $("#backupkeuangan").click(() => {
    getData(`${baseurl}/backupKeuangan`);
    title.html("Keuangan");
    title2.html("Keuangan");
    list.html("view");
    menu("#backup");
  });
  //postingan
  $("#backuppostingan").click(() => {
    getData(`${baseurl}/backupPostingan`);
    title.html("Postingan");
    title2.html("Postingan");
    list.html("view");
    menu("#backup");
  });
  //kegiatan
  $("#backupkegiatan").click(() => {
    getData(`${baseurl}/backupKegiatan`);
    title.html("Kegiatan");
    title2.html("Kegiatan");
    list.html("view");
    menu("#backup");
  });
  // Backup Data

  // moderator fitur
  // member
  $("#fiturmember").click(() => {
    getData(`${baseurl}/apiMember`);
    title.html("Member");
    title2.html("Member");
    list.html("view");
    menu("#fiturmember");
  });
  //surat
  $("#fitursurat").click(() => {
    getData(`${baseurl}/apiSurat`);
    title.html("Surat");
    title2.html("Surat");
    list.html("view");
    menu("#fitursurat");
  });
  //keuangan
  $("#fiturkeuangan").click(() => {
    getData(`${baseurl}/apiKeuangan`);
    title.html("Keuangan");
    title2.html("Keuangan");
    list.html("view");
    menu("#fiturkeuangan");
  });
  //postingan
  $("#fiturpostingan").click(() => {
    getData(`${baseurl}/apiPostingan`);
    title.html("Postingan");
    title2.html("Postingan");
    list.html("view");
    menu("#fiturpostingan");
  });
  $("#fiturkegiatan").click(() => {
    getData(`${baseurl}/apiKegiatan`);
    title.html("Kegiatan");
    title2.html("Kegiatan");
    list.html("view");
    menu("#fiturkegiatan");
  });
  // moderator fitur
});
