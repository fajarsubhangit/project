<?php
class Auth_model extends CI_Model {
  var $tabel_user = "user";

  //tampilkan data tabel user berdasarkan username
  public function get_row($username) {
    $this->db->where("user_username",$username);
    return $this->db->get($this->tabel_user)->row();
  }

}
 ?>
