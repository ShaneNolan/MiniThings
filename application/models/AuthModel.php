<?php
class AuthModel extends CI_Model {
  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  function getToken($id){
    $this->db->select("TOKEN, EXPIRE");
		$this->db->from('authentication');
		$this->db->where('USER_ID', $id);
    $this -> db -> limit(1);

		$query = $this->db->get();

    if($query -> num_rows() == 1)
      return $query->result();
		return false;
  }

  function addToken($token){
    $this->db->insert('authentication', $token);
    if($this->db->affected_rows() == 1)
      return true;
    else
      return false;
  }
}
?>
