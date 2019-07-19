<?php
class Auth extends CI_Controller {
  public function __construct() {
    parent::__construct();

    //load auth model
    $this->load->model("Auth_model");
  }

  public function index() {
    if($this->session->userdata("hak_akses") === "Admin"){
      redirect(base_url("admin"));
    }
    else if($this->session->userdata("hak_akses") === "User") {
      redirect(base_url("user"));
    }

    $this->data["title"] = "Fajar Subhan";

    $this->load->view("login/index",$this->data);
  }

  public function login_proses() {
    if($this->validation() === false) {
      $this->index();
    }
    else {
      $username = htmlentities(strip_tags(trim($_POST["username"])));
      $password = htmlentities(strip_tags(trim($_POST["password"])));

      $row  = $this->Auth_model->get_row($username);
      $hash = $row->user_password;

      if($username !== $row->user_username) {
        $this->session->set_flashdata("usernameError","<div class='error'>username tidak benar</div>");
        redirect(base_url());
      }
      else if(!password_verify($password,$hash)) {
        $this->session->set_flashdata("passwordError","<div class='error'>password tidak benar</div>");
        redirect(base_url());
      }
      else {

        if(isset($_POST["remember"])) {
          set_cookie("username",$username,60*60*24*7);
          set_cookie("password",$password,60*60*24*7);
        }
        else {
          set_cookie("username","");
          set_cookie("password","");
        }

        $session = array (
          "nama"      => $row->user_nama,
          "username"  => $row->user_username,
          "hak_akses" => $row->user_hak_akses
        );

        $this->session->set_userdata($session);
        //periksa apakah hak akses admin,jika admin makan redirect ke admin
        if($row->user_hak_akses === "Admin") {
          redirect(base_url("admin"));
        }
        //jika user redirect to user
        else if($row->user_hak_akses === "User") {
          redirect(base_url("user"));
        }
      }

    }
  }

  public function validation() {
    $this->form_validation->set_rules("username","username","required");
    $this->form_validation->set_rules("password","password","required");

    $this->form_validation->set_message("required","{field} wajib di isi");

    $this->form_validation->set_error_delimiters("<div class='error'>","</div>");
    if($this->form_validation->run()) {
      return true;
    }
    else {
      return false;
    }
  }
}
 ?>
