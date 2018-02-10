<?php
class LoginModel extends CI_Model {

  function __construct(){
    parent::__construct();
    $this->load->database();
  }

  function login($email, $password){
    $user = $this->helper_login($email, 'admins');
    if($user -> num_rows() == 1){
      $user = $user->result();
      if(password_verify($password, $user[0]->password))
        return $user;
    }
    $user = $this->helper_login($email, 'customers');
    if($user -> num_rows() == 1){
      $user = $user->result();
      if(password_verify($password, $user[0]->password))
        return $user;
    }
    return false;
  }
  private function helper_login($email, $table){
    $this->db->select('*');
    $this->db->from($table);
    $this->db->where('email', $email);
    $this->db->limit(1);
    return $this->db->get();
  }

  function updateAdmin($admin){
    $this->db->where('customerNumber', $admin["customerNumber"]);
  	return $this->db->update('admins', $admin);
  }

  function invalidPin($id){
    $this->db->set('pin_attempts', 'pin_attempts+1', FALSE);
    $this->db->where('customerNumber', $id);
    $this->db->update('admins');
  }

  function register($customer){
    $customer["password"] = password_hash($customer["password"], PASSWORD_DEFAULT);
    $this->db->insert('customers', $customer);
    if ($this->db->affected_rows() == 1)
      return true;

    return false;
  }

  function registerAdmin($admin){
    $this->db->insert('admins', $admin);
    if ($this->db->affected_rows() == 1)
      return true;

    return false;
  }

  function getAdmins(){
    $this->db->select('customerNumber, email');
    $this->db->from('admins');
    return $this->db->get()->result();
  }

  function getUser($id, $table){
    $this->db->select("*");
		$this->db->from($table);
		$this->db->where('customerNumber', $id);
    $this->db->limit(1);

		$query = $this->db->get();
    return $query->result();
  }
}
?>
