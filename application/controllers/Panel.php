<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("classes/persona.class.php");

class Panel extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
        //TODO: Parsear templates con las variables de la base de datos
        $this->load->library('parser');
		$this->load->helper('url');
		$this->load->library('session');
	}
	public function index(){
        $data = array();
        $data['user'] = $this->session->userdata();
		$this->load->view('header', $data);
		$this->load->view('index', $data);
		$this->load->view('footer');
	}
	public function login(){
        $data = array(
            'error' => $this->session->flashdata('error'),
			'warning' => $this->session->flashdata('warning')
        );
		$this->load->view('header');
		$this->load->view('login', $data);
		$this->load->view('footer');
	}
    public function logout(){
        $user_session = array('id', 'username', 'role');
        $this->session->unset_userdata($user_session);
        redirect('panel/index');
    }
	public function doLogin(){
		if($this->input->post()){

			$this->load->model('panel_model');
			$user = $this->panel_model->userLogin($this->input->post('user'), md5($this->input->post('pass')));

			if($user){
				$user_session = array('id'=>$user->id, 'username'=>$user->username, 'role'=>$user->roleID);
				$this->session->set_userdata($user_session);
                redirect('panel/system');
			}else{
				$this->session->set_flashdata('error', "¡Los datos ingresados son incorrectos! Intente nuevamente.");
                redirect('panel/login');
			}
			
		}else{
			$this->login();
		}

	}
	public function recover(){
		//TODO: implementar reCAPTCHA
		$data = array(
			'error' => $this->session->flashdata('error'),
			'success' => $this->session->flashdata('success'),
		);
		$this->load->view('header');
		$this->load->view('recover', $data);
		$this->load->view('footer');

	}
	public function doRecover(){
		if($this->input->post()){
			$this->load->model('panel_model');
			$user = $this->panel_model->userRecover($this->input->post('email'));

			if($user){
				$this->session->set_flashdata('success', "Se han enviado las instrucciones de acceso a su email.");
			}else{
				$this->session->set_flashdata('error', "No existe un usuario para el mail ingresado.");
			}
			redirect('panel/recover');
		}
	}
	public function system(){
		if($this->session->userdata('username')){
			$this->load->view('header');
			$this->load->view('panel');
			$this->load->view('footer');
		}else{
			$this->session->set_flashdata('warning', "Para ingresar al sistema debe estar logueado.");
			redirect('panel/login');
		}
	}
}
