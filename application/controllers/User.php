<?php
class User extends CI_Controller {
  public function __construct() {
    parent::__construct();

    //load model user
    $this->load->model("User_model");
  }

  public function index() {


    $this->data["title"] = "Dashboard User";

    $this->load->view("user/index",$this->data);
  }
}
 ?>
