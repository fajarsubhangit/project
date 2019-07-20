<?php
class Admin extends CI_Controller {
  public function __construct() {
    parent::__construct();

    //load admin model
    $this->load->model("Admin_model");
    //session berakhir/user tidak boleh masuk kecuali sudah login sebagai admin
    if(!$this->session->userdata("hak_akses")) {
      redirect(base_url());
    }
  }

  public function index() {
    $this->data["title"] = "Dashboard Admin";

    $this->load->view("admin/index",$this->data);
  }

  //view data user
  public function data_user() {
    $this->data["title"] = "Data User";

    //load data
    $this->data["data_user"] = $this->Admin_model->get_all_user();

    $this->load->view("admin/data_user",$this->data);
  }

  public function tambah_user() {
    if($this->validasiUser()) {
      $nama     = htmlentities(strip_tags(trim($_POST["namauser"])));
      $username = htmlentities(strip_tags(trim($_POST["username"])));
      $password = htmlentities(strip_tags(trim($_POST["password"])));
      $akses    = htmlentities(strip_tags(trim($_POST["hak_akses"])));


      $data = array (
        "user_nama" => $nama,
        "username"  => $username,
        "user_password"  => password_hash($password,PASSWORD_DEFAULT),
        "user_hak_akses" => $akses
      );

      $this->Admin_model->insertData($data);

      $this->data["data_user"] = $this->Admin_model->get_all_user();
      $tabel  = $this->load->view("admin/tabel_user",$this->data,true);

      $status = array (
        "status" => "berhasil",
        "pesan"  => "Data berhasil di simpan",
        "tabel"   => $tabel
      );
    }
    else {

      $nama = strip_tags(form_error("namauser"));
      $username = strip_tags(form_error("username"));
      $password = strip_tags(form_error("password"));
      $hak_akses = strip_tags(form_error("hak_akses"));

      $status = array (
        "status" => "gagal",
        "nama"   => $nama,
        "username" => $username,
        "password" => $password,
        "hak_akses" => $hak_akses
      );
    }
    echo json_encode($status,JSON_PRETTY_PRINT);
  }

  //ubah data berdasarkan ID
  public function ubah_data($id) {
    sleep("2");
    $nama      = htmlentities(strip_tags(trim($_POST["namauser"])));
    $username  = htmlentities(strip_tags(trim($_POST["username"])));
    $hak_akses = htmlentities(strip_tags(trim($_POST["hak_akses"])));

    $data = array (
      "user_nama" => $nama,
      "username"  => $username,
      "user_hak_akses" => $hak_akses
    );

    $query = $this->Admin_model->ubah($id,$data);
    $this->data["data_user"] = $this->Admin_model->get_all_user();
    $html = $this->load->view("admin/tabel_user",$this->data,true);

    if($query === true) {
      $status = array(
        "status" => "berhasil",
        "pesan" => "Data berhasil di ubah",
        "html"  => $html
      );
    }else {
      $status = array("status" => "gagal");
    }
      echo json_encode($status,JSON_PRETTY_PRINT);


  }


  //validasi untuk form data user
  function validasiUser() {
    $this->form_validation->set_rules("namauser","nama","required");
    $this->form_validation->set_rules("username","username","required|is_unique[user.username]");
    $this->form_validation->set_rules("password","password","required|min_length[6]");
    $this->form_validation->set_rules("hak_akses","hak akses","required");

    $this->form_validation->set_message("required","{field} wajib di isi");
    $this->form_validation->set_message("is_unique","{field} sudah digunakan");
    $this->form_validation->set_message("min_length","{field} minimal 6 karakter");

    if($this->form_validation->run()) {
      return true;
    }
    else {
      return false;
    }
  }

}
 ?>
