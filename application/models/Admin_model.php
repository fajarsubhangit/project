<?php
class Admin_model extends CI_Model {
  var $tabel_user = "user";
  var $tabel_referral = "referral";

  //tampilkan seluruh tabel data user
  public function get_all_user() {
    $this->db->order_by("user_id","desc");
    return $this->db->get($this->tabel_user)->result();
  }

  //tambah data user
  public function insertData($data) {
    $this->db->insert($this->tabel_user,$data);
  }

}
 ?>
