<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// if($this->session->userdata('level_user')){
		// 	redirect('users');
		// }
		$this->form_validation->set_rules('username','Username','trim|required',['required'=>'username harus diisi']);
		$this->form_validation->set_rules('password','Password','trim|required',['required'=>'Password harus diisi']);
		if ($this->form_validation->run() == FALSE){
			$this->load->view('auth/login');
		}else{
			$this->_login();
		}
	}

	private function _login()
	{
		$username=htmlspecialchars(strtolower($this->input->post('username',true)));
		$password=htmlspecialchars($this->input->post('password',true));

		$users=$this->db->get_where('users',['username_user'=>$username,'password_user'=>$password])->row_array();
		if($users){
			$data=[
				'id_user'=>$users['id_user'],
				'level_user'=>$users['level_user']
			];
			$this->session->set_userdata($data);
			redirect('users');
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Username/password
		              <strong> salah! </strong>.
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>');
			$this->load->view('auth/login');
			return false;
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id_user');
		// $this->session->unset_userdata('tipe_user');
		$this->session->unset_userdata('level_user');
		redirect('users');
	}


}