<?php
class User_model extends CI_Model {
  var $tabel_referral = "referral";

  //insert data
  public function insertData($data) {
    $this->db->insert($this->tabel_referral,$data);
  }
}
 ?>
