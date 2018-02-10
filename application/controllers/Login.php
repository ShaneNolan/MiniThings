<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('LoginModel');
    $this->load->model('AuthModel');
		$this->load->helper('form');
    $this->load->helper('cookie');
		$this->load->library('form_validation');
    $this->load->library('Helpers');
  }

	public function index()
	{
    if($this->session->userdata('logged_in'))
      redirect('Home');
		else
      $this->view();
	}

  function _SetRememberMe() {
    $user_token["TOKEN"] = bin2hex(openssl_random_pseudo_bytes("128", $cstrong));
    $user_token["USER_ID"] = $this->SESSION->customerNumber;
    $user_token["EXPIRE"] = date('Y-m-d H:i:s', strtotime('+7 day', time()));
    $this->AuthModel->addToken($user_token);

    $cookie = $user_token["USER_ID"] . ":" . $user_token["TOKEN"];
    $mac = hash_hmac('sha256', $cookie, $this->KEY);

    $this->input->set_cookie(array(
      'name' => 'minithings_remember_me',
      'value' => $cookie . ":" . $mac,
      'expire' => 7*24*60*60*1000
    ));
  }

  function view() {
    $this->load->view('header');
    $this->load->view('login');
    $this->load->view('footer');
  }

  function login() {
   $this->form_validation->set_rules('email', 'Email', 'trim|required');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|callback__checkPassword');

   if(!$this->form_validation->run())
    $this->view();
   else
    redirect('Home');
  }

  function _checkPassword($password) {
    $email = $this->input->post('email', TRUE);
    $query = $this->LoginModel->login($email, $password);

    if($query) {
      $this->start_session($query[0]);
      if($this->input->post('remember_me', TRUE))
        $this->_SetRememberMe();
      return true;
     } else {
       $this->form_validation->set_message('_checkPassword', 'Invalid email or password.');
       return false;
     }
   }

   function logout() {
     $this->load->view('header');
     $data["message"] = "Logging out . . .";
     $this->load->view('loading', $data);
     $this->load->view('footer');

     $this->session->unset_userdata('logged_in');
     $this->session->sess_destroy();
     delete_cookie($this->COOKIE_NAME);
     header('Refresh: 1; URL=' . base_url());
   }

   function register($data = null) {
     if($this->SESSION)
       redirect('Home');
     else {
       $this->load->view('header');
       if($data == null) { $data["customer"] = null; }
       $this->load->view('register', $data);
       $this->load->view('footer', $data);
     }
   }

   function registeradmin($data = null){
     if($this->isAdmin()){
       $this->load->view('header');
       $this->load->view('registeradmin', $data);
       $this->load->view('footer');
     }else
      redirect('home');
   }

   function pinlock($data = null, $logout = false){
     $this->load->view('header');
     $this->load->view('pinlock', $data);
     $this->load->view('footer');

     if($logout)
      header('Refresh: 2; URL=' . site_url() . '/login/logout');
   }

   function pinunlock(){
     $logout = false;
     if($this->SESSION->pin_attempts > 3){
      $data["message"] = "Your account has been locked, please contact an administrator.";
      $logout = true;
     }else{
       if($this->encrypt->decode($this->SESSION->pin) == $this->input->post('pin', TRUE)){
         $admin["customerNumber"] = $this->SESSION->customerNumber;
         $admin["pin_attempts"] = 0;
         $admin["last_ip"] = $_SERVER['REMOTE_ADDR'];
         $this->LoginModel->updateAdmin($admin);

         $this->SESSION->last_ip = $_SERVER['REMOTE_ADDR'];
         redirect('home');
       }else{
         $this->LoginModel->invalidPin($this->SESSION->customerNumber);
         $this->SESSION->pin_attempts += 1;
         $data["message"] = "Invalid pin entered.";
       }
     }
     $this->pinlock($data, $logout);
   }

   function create() {
     $inputs = array("first_name" => "First Name|contactFirstName",
                     "last_name" => "Last Name|contactLastName",
                     "email" => "Email|email",
                     "phone" => "Phone|phone",
                     "password" => "Password|password",
                     "confirm_password" => "Confirmation Password",
                     "company_name" => "Company Name|customerName",
                     "line_one" => "Address Line One|addressLine1",
                     "line_two" => "Address Line Two|addressLine2",
                     "city" => "City|city",
                     "state" => "State|state",
                     "country" => "Country|country",
                     "post_code" => "Post Code|postalCode");

    $customer = $this->helpers->createPostObject($inputs);
    unset($customer[0]);

    if(!$this->form_validation->run()){
      $this->register();
    }else{
      $this->load->view('header');
      $data["message"] = "Creating " .
      htmlspecialchars($this->input->post('first_name'), ENT_QUOTES, 'UTF-8') . "'s account . . .";
      $this->load->view('loading', $data);
      $this->load->view('footer');

      if($this->LoginModel->register($customer)){
        $this->_checkPassword($customer["password"]);
        header('Refresh: 2; URL=' . base_url());
      } else {
        $data["customer"] = $customer;
        $data["message"] = "Unable to register your account.";
        $data["scripts"] = '<script> $( document ).ready(function() { $("#form_one input").each(function(){ $(this).focus(); }); $("input[name=\"first_name\"]").focus(); }); </script>';
        $this->register($data);
      }
    }
   }

   function createadmin() {
    $admin = $this->helpers->createPostObject(array("email" => "Email|email",
                    "password" => "Password|password"));

    if(!$this->form_validation->run()){
      $this->registeradmin();
    }else{
      $this->load->view('header');
      $data["message"] = "Creating " .
      htmlspecialchars($this->input->post('first_name'), ENT_QUOTES, 'UTF-8') . "'s account . . .";
      $this->load->view('loading', $data);
      $this->load->view('footer');
      $this->encrypt->decode($this->SESSION->pin);
      $pin = null;
      while(strlen($pin) != 4)
          $pin = abs(round(hexdec(bin2hex(openssl_random_pseudo_bytes(10, $cstrong))) % 10000));

      $admin["pin"] = $this->encrypt->encode($pin);
      if($this->LoginModel->registerAdmin($admin)){
        $this->_checkPassword($admin["password"]);
        $data["message"] = '<h4>Admin PIN</h4>Welcome, Admin your one time pin is : <strong>'
        . $pin . '</strong><br><br><span style="color:red;">DO NOT FORGET THIS PIN. YOU WILL BE
        LOCKED OUT OF YOUR ACCOUNT PERMANENTLY IF FORGOTTEN.</span>';
        $this->load->view('header');
        $this->load->view('confirm', $data);
        $this->load->view('footer');
      } else {
        $data["message"] = "Unable to register your account.";
        $this->registeradmin($data);
      }
    }
   }
}
