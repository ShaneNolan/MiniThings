<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    if(!$this->isAdmin())
      redirect('home');
    $this->load->model('ProductModel');
    $this->load->model('LoginModel');
  }

	public function index()
	{
    redirect('home');
	}

  public function resetPin($id){
    if(!empty($id)){
      $admin["customerNumber"] = $id;
      $admin["pin_attempts"] = 0;
      $this->LoginModel->updateAdmin($admin);
      $data["message"] = "<h4>Admin Pin</h4>Admin ID: " . $id . "'s pin has <strong>unlocked.</strong>";
      $this->view($data);
    }else
        $this->index();
  }

  private function view($data){
    $this->load->view('header');
    $this->load->view('confirm', $data);
    $this->load->view('footer');
  }

  public function resetPassword($id){
    if(!empty($id)){
      $sets = array('abcdefghjkmnpqrstuvwxyz', 'ABCDEFGHJKMNPQRSTUVWXYZ',
                    '23456789', '!@#$%&*?');
    	$temp_sets = '';
      $password = '';
    	foreach($sets as $set)
    	{
    		$password .= $set[mt_rand(0, count(str_split($set)) - 1)];
    		$temp_sets .= $set;
    	}

    	$temp_sets = str_split($temp_sets);
    	for($i = 0; $i < 10 - count($sets); $i++)
    		$password .= $temp_sets[mt_rand(0, count($temp_sets) - 1)];

      $admin["plain"] = str_shuffle($password);
    	$admin["password"] = password_hash($admin["plain"], PASSWORD_DEFAULT);
      $admin["customerNumber"] = $id;
      $this->LoginModel->updateAdmin($admin);
      $data["message"] = "<h4>Admin Password</h4>Admin ID: " . $id . "'s password has changed to: <strong>"
      . $admin["plain"] . "</strong>";
      $this->view($data);
    }else
        $this->index();
  }
}
