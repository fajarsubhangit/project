<?php
class Admin_model extends CI_Model {
  var $tabel_user = "user";
  var $tabel_referral = "referral";

  //tampilkan seluruh tabel data user
  public function get_all_user() {
    return $this->db->get($this->tabel_user)->result();
  }
}
 ?>
