<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  public $css_base, $img_base, $scripts_base;
  public $cstrong = true;
  public $KEY, $COOKIE_NAME, $SESSION;

  public function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    $this->load->library('encrypt');
    $this->load->helper('url');
    $this->css_base = base_url() . "assets/css/";
    $this->img_base = base_url() . "assets/images/";
    $this->scripts_base = base_url() . "assets/scripts/";

    $this->KEY = $this->encrypt->encode('shaneN01AN!');
    $this->COOKIE_NAME = 'minithings_remember_me';

    $this->SESSION = $this->session->userdata('logged_in');
    if($this->isAdmin()){
      if($this->SESSION->last_ip != $_SERVER['REMOTE_ADDR']
                && !strpos($_SERVER['REQUEST_URI'], "login")){
        redirect('login/pinlock');
      }
    }
    if(!$this->SESSION)
      $this->GetRememberMe();
  }

  public function isAdmin(){
    return $this->SESSION ? $this->SESSION->admin : false;
  }

  private function GetRememberMe() {
    $this->load->model('AuthModel');
    $cookie = $this->input->cookie($this->COOKIE_NAME, true);
    if($cookie){
      list ($id, $token, $mac) = explode(':', $cookie);
      if(hash_equals(hash_hmac('sha256', $id . ':' . $token, $this->KEY), $mac)){
        $user_token = $this->AuthModel->getToken($id);
        if($user_token[0]->EXPIRE > date('Y-m-d H:i:s')){
          if(hash_equals($user_token[0]->TOKEN, $token))
            $this->start_session($id);
        }
      }
    }
  }

  protected function start_session($user){
    unset($user->password);
    $user->admin = array_key_exists('pin', $user) ? true : null;
    $sess_array = $user;
    $this->session->set_userdata('logged_in', $sess_array);
   }
}
