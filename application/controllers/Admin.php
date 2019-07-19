<?php
class Admin extends CI_Controller {
  public function __construct() {
    parent::__construct();

    //load admin model
    $this->load->model("Admin_model");
  }

  public function index() {
    $this->data["title"] = "Dashboard Admin";

    $this->load->view("admin/index",$this->data);
  }

  public function data_user() {
    $this->data["title"] = "Data User";

    //load data
    $this->data["data_user"] = $this->Admin_model->get_all_user();

    $this->load->view("admin/data_user",$this->data);
  }
}
 ?>
