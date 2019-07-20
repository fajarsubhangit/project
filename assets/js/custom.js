var id;

$(document).ready(function() {
  $("#tabel").DataTable();

  // <== LOGIN

  //login validasi
  $("#formLogin").submit(function(e) {
    if($("#usernameLogin").val().trim() === "") {
      $("#usernameError").html("<i class='fas fa-exclamation-triangle'></i> username wajib di isi");
      $("#usernameError").addClass("error");
      e.preventDefault();
    }
    else {
      $("#username").addClass("success");
    }

    if($("#passwordLogin").val().trim() === "") {
      $("#passwordError").html("<i class='fas fa-exclamation-triangle'></i> password wajib di isi");
      $("#passwordError").addClass("error");
      e.preventDefault();
    }
    else {
      $("#password").addClass("success");
    }
  })

  $("#usernameLogin").focus(function() {
    $("#usernameError").html("");
    $("#usernameError").removeClass("error");
  })

  $("#passwordLogin").focus(function() {
    $("#passwordError").html("");
    $("#passwordError").removeClass("error");
  })

  // ==> END LOGIN

  // <== DATA USER TAMBAH

  //hide loading data dan error
  $("#loading-simpan,#loading-hapus,#loading-ubah").hide();

  //ketika tombol + tambah user
  $("#tambah_user").click(function() {
    //sembunyikan tombol ubah
    $("#ubah").hide();
    //berikan judul
    $("#modal-title").html("<i class='fas fa-user-plus'></i> TAMBAH USER")

    $(".password").show();
    $("#simpan").show();
  });//TOMBOL #tambah_user close

  //Buat validasi dan input data ke ajax /*
  $("#simpan").click(function() {
    var nama     = $("#namaInput").val().trim();
    var username = $("#usernameInput").val().trim();
    var password = $("#passwordInput").val().trim();
    var hakakses = $("#hakaksesinput").val().trim();
    //nama lengkap
    if(nama === "") {
      $("#namauserError").html("<i class='fas fa-exclamation-triangle'></i> nama lengkap wajib di isi");
      $("#namauserError").addClass("error");
      $("#nama").addClass("error");
      $("#nama").removeClass("success");
    }
    else {
      $("#namauserError").removeClass("error");
      $("#nama").removeClass("error");
      $("#nama").addClass("success");
    }


    //username
    if(username === "") {
      $("#usernameError").html("<i class='fas fa-exclamation-triangle'></i> username wajib di isi");
      $("#usernameError").addClass("error");
      $("#username").addClass("error");
      $("#username").removeClass("success");
    }
    //username hanya menggunakan alfanumerik saja minimal 5 maksimal 20 karakter
    else if(/^[A-Za-z0-9 ]{5,20}$/.test(username) === false) {
      $("#usernameError").html("<i class='fas fa-exclamation-triangle'></i> di isi dengan alfanumerik min 5 dan maks 20 karakter");
      $("#usernameError").addClass("error");
      $("#username").addClass("error");
      $("#username").removeClass("success");
    }
    else {
      $("#usernameError").removeClass("error");
      $("#username").removeClass("error");
      $("#username").addClass("success");
    }


    //password
    if(password === "") {
      $("#passwordError").html("<i class='fas fa-exclamation-triangle'></i> password wajib di isi");
      $("#passwordError").addClass("error");
      $("#password").addClass("error");
      $("#password").removeClass("success");
    }
    //password minimal 6 karakter
    else if(password.length <= 6) {
      $("#passwordError").html("<i class='fas fa-exclamation-triangle'></i> password minimal 6 karakter");
      $("#passwordError").addClass("error");
      $("#password").addClass("error");
      $("#password").removeClass("success");
    }
    else {
      $("#passwordError").removeClass("error");
      $("#password").removeClass("error");
      $("#password").addClass("success");
    }

    //hak akses
    if(hakakses === "") {
      $("#hakaksesError").html("<i class='fas fa-exclamation-triangle'></i> hak akses wajib di pilih");
      $("#hakaksesError").addClass("error");
      $("#hakakses").addClass("error");
      $("#hakakses").removeClass("success");
    }else {
      $("#hakaksesError").removeClass("error");
      $("#hakaksespassword").removeClass("error");
      $("#hakakses").addClass("success");
    }


    if( $("#namauserError").html() === "" && $("#usernameError").html() === "" && $("#passwordError").html() === "" && $("#hakaksesError").html() === "") {
      //masukan semua data ke database lewat ajax
      var data = $("#form").serialize();
      console.log(data);

      $.ajax({
        url: "tambah_user",
        method: "post",
        dataType: "json",
        data: data,
        beforeSend: function() {
          $("#loading-simpan").show();
        },
        success: function(response) {
          if(response.status === "berhasil") {
            $("#loading-simpan").hide();
            Swal.fire({
              type:"success",
              title: "Berhasil",
              text: response.pesan
            })
            $("#view").html(response.tabel);
            $("#form")[0].reset();
            $("#nama,#username,#password,#hakakses").removeClass("success");
            $("#modal").hide();
            $(".modal-backdrop").hide();
            $("body").removeClass("modal-open");
            $("#tabel").DataTable();
          }
          else {
            //validasi form
            if(response.nama !== "") {
              $("#namauserError").html("<i class='fas fa-exclamation-triangle'></i> " + response.nama);
              $("#nama").addClass("error");
              $("#namauserError").addClass("error");
            }

            if(response.username !== "") {
              $("#usernameError").html("<i class='fas fa-exclamation-triangle'></i> " + response.username);
              $("#username").addClass("error");
              $("#usernameError").addClass("error");
            }

            if(response.password !== "") {
              $("#passwordError").html("<i class='fas fa-exclamation-triangle'></i> " + response.password);
              $("#password").addClass("error");
              $("#passwordError").addClass("error");
            }

            if(response.hak_akses !== "") {
              $("#hakaksesError").html("<i class='fas fa-exclamation-triangle'></i> " + response.hak_akses);
              $("#hakakses").addClass("error");
              $("#hakaksesError").addClass("error");
            }

          }

        }
      });
    }

  }); //Close #tombol simpan di klik

  // ==> END USER TAMBAH

  //ketika tombol ubah di klik
  $("#view").on("click","#ubahData",function() {
    id = $(this).data("id");
    $("#ubah").show();
    $("#simpan").hide();
    $(".password").hide();
    $("#modal-title").html("<i class='fas fa-user-edit'></i> UBAH DATA USER");

    var tr = $(this).closest("tr");
    var nama = tr.find(".namauser-value").val().trim();
    var username = tr.find(".username-value").val().trim();
    var hakakses = tr.find(".hakakses-value").val().trim();

    $("#namaInput").val(nama);
    $("#usernameInput").val(username);
    $("#hakaksesinput").val(hakakses);
  })

  //masukan data ubah user
  $("#ubah").click(function() {
    var nama = $("#namaInput").val().trim();
    var username = $("#usernameInput").val().trim();
    var hakakses = $("#hakaksesinput").val().trim();

    var data = "namauser="+nama+"&username="+username+"&hak_akses="+hakakses;
    console.log(data);
    $.ajax({
      url: "ubah_data/"+id,
      method: "post",
      dataType: "json",
      data: data,
      beforeSend: function() {
        $("#loading-ubah").show();
      },
      success: function(msg) {
        if(msg.status === "berhasil") {
          $("#loading-ubah").hide();
          $("#modal").hide();
          $(".modal-backdrop").hide();
          $("body").removeClass("modal-open");
          Swal.fire({
            type: "success",
            title: "Berhasil",
            text: msg.pesan
          })

          $("#view").html(msg.html);
        }
      }

    })
  })

  //ketika icon view password di klik
  $("#viewPass").click(function() {
    if($("#passwordInput")[0].type === "password") {
      $("#passwordInput")[0].type = "text";
      $("#viewPass #view").html("<i class='fas fa-eye'></i>");
    }
    else {
      $("#passwordInput")[0].type = "password";
      $("#viewPass #view").html("<i class='fas fa-eye-slash'></i>");
    }
  })

  //hapus error
  //nama user
  $("#namaInput").focus(function() {
    $("#namauserError").removeClass("error");
    $("#nama").removeClass("error");
    $("#namauserError").html("");
  })
  //username
  $("#usernameInput").focus(function() {
    $("#usernameError").removeClass("error");
    $("#username").removeClass("error");
    $("#usernameError").html("");
  })
  //password
  $("#passwordInput").focus(function() {
    $("#passwordError").removeClass("error");
    $("#password").removeClass("error");
    $("#passwordError").html("");
  })
  //hak akses
  $("#hakaksesinput").change(function() {
    $("#hakaksesError").removeClass("error");
    $("#hakakses").removeClass("error");
    $("#hakaksesError").html("");
  })

  //tombol tutup di klik
  $("#tutup").click(function() {
    $("#form")[0].reset();
    $("#usernameError,#namauserError,#passwordError,#hakaksesError").html("");
    $("#usernameError,#namauserError,#passwordError,#hakaksesError").removeClass("error");
    $("#nama,#username,#password,#hakakses").removeClass("success");
    $("#nama,#username,#password,#hakakses").removeClass("error");
    $("#loading-simpan,#loading-ubah,#loadin-hapus").hide()
  })

})
