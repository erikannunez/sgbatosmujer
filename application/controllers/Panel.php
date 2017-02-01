<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require("classes/persona.class.php");
require("classes/email.class.php");

class Panel extends CI_Controller
{
	/*
	** Constructor
	*/
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->helper('url');
		$this->load->model('panel_model');
		$this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('pagination');
        $this->load->library('session');
    }

	/*
	** Control de sesión y recuperación de password
	*/
	
    public function control(){
        if($this->session->userdata('logueado') == FALSE){
			$this->session->set_flashdata('warning', "Para acceder al sistema debe estar logueado.");
            redirect('panel/login');   
        }
    }

    public function login()
    {
        $data = array(
            'error' => $this->session->flashdata('error'),
            'warning' => $this->session->flashdata('warning'),
            'user' => $this->session->userdata()
        );
        $this->load->view('header', $data);
        $this->load->view('login', $data);
        $this->load->view('footer');
    }

    public function logout(){
		$this->control();
        $user_session = array('id', 'username', 'role', 'logueado');
        $this->session->unset_userdata($user_session);
        redirect('panel/index');
    }

    public function doLogin()
    {
        if ($this->input->post()) {

            $user = $this->panel_model->userLogin($this->input->post('user'), md5($this->input->post('pass')));

            if ($user) {
                $user_session = array('id' => $user->id, 'username' => $user->username, 'role' => $user->roleID, 'logueado' => TRUE);
                $this->session->set_userdata($user_session);
                redirect('panel/system');
            } else {
                $this->session->set_flashdata('error', "¡Los datos ingresados son incorrectos! Intente nuevamente.");
                redirect('panel/login');
            }

        } else {
            $this->login();
        }

    }

    public function recover()
    {
        //TODO: implementar reCAPTCHA
        $data = array(
            'error' => $this->session->flashdata('error'),
            'success' => $this->session->flashdata('success'),
            'user' => $this->session->userdata()
        );
        $this->load->view('header', $data);
        $this->load->view('recover', $data);
        $this->load->view('footer');

    }

    public function doRecover()
    {
        if ($this->input->post()) {
            $user = $this->panel_model->userRecover($this->input->post('email'));

            if ($user) {
                $this->email->from('vidaliquidamkt@gmail.com', 'Depto. de la Mujer (SGBATOS)');
                $this->email->to("erikannunez@gmail.com");
                $this->email->subject('Recuperar contraseña');
                $this->email->message('Para recuperar su contraseña ingrese en el siguiente link: <a href="">recuperar contraseña</a>.');
                if ($this->email->send()) {
                    $this->session->set_flashdata('success', "Se han enviado las instrucciones de acceso a su email.");
                } else {
                    $this->session->set_flashdata('error', $this->email->print_debugger());
                }

            } else {
                $this->session->set_flashdata('error', "No existe un usuario para el mail ingresado.");
            }
            redirect('panel/recover');
        }
    }

	/*
	** Página y Panel Principal
	*/
	
    public function index(){
		$this->control();
        $data = array();
        $data['user'] = $this->session->userdata();
		$data['cumplen'] = $this->panel_model->getCumpleaneros();
        $this->load->view('header', $data);
        $this->load->view('index', $data);
        $this->load->view('footer');
    }
	
    public function system()
    {
        $this->control();
        $config = array(
                'base_url' => site_url('panel/system'),
                'total_rows' => $this->panel_model->recordCount(),
                'per_page' => 50,
                'uri_segment' => 3,
                'num_links' => 10,
                'full_tag_open' => '<ul class="pagination pagination-sm">',
                'full_tag_close' => '</ul>',
                'first_link' => false,
                'last_link' => false,
                'first_tag_open' => '<li>',
                'first_tag_close' => '</li>',
                'prev_link' => '&laquo',
                'prev_tag_open' => '<li class="prev">',
                'prev_tag_close' => '</li>',
                'next_link' => '&raquo',
                'next_tag_open' => '<li>',
                'next_tag_close' => '</li>',
                'last_tag_open' => '<li>',
                'last_tag_close' => '</li>',
                'cur_tag_open' => '<li class="active"><a href="#">',
                'cur_tag_close' => '</a></li>',
                'num_tag_open' => '<li>',
                'num_tag_close' => '</li>'
            );

		$this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'error' => $this->session->flashdata('error'),
                'warning' => $this->session->flashdata('warning'),
                'success' => $this->session->flashdata('success'),
                'user' => $this->session->userdata(),
                'personas' => $this->panel_model->fetchPersonas($config["per_page"], $page),
                'links' => $this->pagination->create_links(),
                'totalCount' => $this->panel_model->recordCount(),
                'search' => NULL
            );

            $this->load->view('header', $data);
            $this->load->view('panel', $data);
            $this->load->view('footer');
    }

    public function search(){
        $this->control();

            $key = $this->input->get('key');

            $config = array(
                'base_url' => site_url('panel/search'),
                'per_page' => 20,
                'uri_segment' => 3,
                'total_rows' => count($this->panel_model->search($key, NULL, NULL)),
                'num_links' => 5,
                'full_tag_open' => '<ul class="pagination pagination-sm">',
                'full_tag_close' => '</ul>',
                'first_link' => false,
                'last_link' => false,
                'first_tag_open' => '<li>',
                'first_tag_close' => '</li>',
                'prev_link' => '&laquo',
                'prev_tag_open' => '<li class="prev">',
                'prev_tag_close' => '</li>',
                'next_link' => '&raquo',
                'next_tag_open' => '<li>',
                'next_tag_close' => '</li>',
                'last_tag_open' => '<li>',
                'last_tag_close' => '</li>',
                'cur_tag_open' => '<li class="active"><a href="#">',
                'cur_tag_close' => '</a></li>',
                'num_tag_open' => '<li>',
                'num_tag_close' => '</li>',
                'reuse_query_string' => TRUE
            );

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data = array(
                'error' => $this->session->flashdata('error'),
                'warning' => $this->session->flashdata('warning'),
                'success' => $this->session->flashdata('success'),
                'user' => $this->session->userdata(),
                'search' => $key,
                'personas' => $this->panel_model->search($key, $config['per_page'], $page),
                'totalCount' => $config['total_rows'],
                'links' => $this->pagination->create_links(),
            );

            $this->load->view('header', $data);
            $this->load->view('panel', $data);
            $this->load->view('footer');
    }	

	/*
	** Altas
	*/
	
    public function add(){
        $this->control();
            $data = array(
                'error' => $this->session->flashdata('error'),
                'warning' => $this->session->flashdata('warning'),
                'success' => $this->session->flashdata('success'),
                'user' => $this->session->userdata()
            );
            $this->load->view('header', $data);
            $this->load->view('add', $data);
            $this->load->view('footer');
    }
	
	public function addPersona(){
		$this->control();
		$persona = new Persona();
        $this->form_validation->set_rules($persona->getRules());
		$this->form_validation->set_rules('fnac','Fecha de Nacimiento', 'callback_validar_fecha');
		$mails = $this->mailCheck();

        if ($this->form_validation->run()){
            $persona->setParams($this->input->post());
			try{
				$lastId = $this->panel_model->addPersona($persona);
				foreach ($mails as $mail){
					$mail->personaID = $lastId;
					$this->panel_model->addMail($mail);
				}
				echo "<div class='alert alert-success' role='alert'>La persona se ha agregado correctamente!<div>";
			} catch (Exception $e){
				echo "<div class='alert alert-danger' role='alert'>Error, el legajo ingresado ya existe!<div>";
			}
        }else{
            echo "<div class='alert alert-danger' role='alert'>",validation_errors(),"<div>";
        }		
	}
	
	/*
	** Bajas
	*/

    public function delete(){
		$this->control();
        $id = $this->input->get('id');
		try{
			$this->panel_model->borrarUsuario($id);
			$this->session->set_flashdata('success', "¡Se ha eliminado la persona correctamente!");
			redirect('panel/system');
			} catch (Exception $e){
				$this->session->set_flashdata('error', "¡La persona ingresada no existe!");
				redirect('panel/system');
			}
    }
	
	public function deleteMail(){
		$this->control();
		$mailID = $this->input->get('mailID');
		$this->panel_model->eliminarMail($mailID);
		echo "<div class='alert alert-success' role='alert'>La mail se ha eliminado correctamente!<div>";
	}

	/*
	** Ediciones
	*/
	
	public function edit(){
		$this->control();
            $data = array(
                'error' => $this->session->flashdata('error'),
                'success' => $this->session->flashdata('success'),
                'user' => $this->session->userdata()
            );
            $data['id']= $this->input->get('id');
			$this->load->view('header', $data);
            $this->load->view('modify', $data);    
            $this->load->view('footer');    
    }
	
    public function updatepersona(){
		$this->control();
		$persona = new Persona();
        $this->form_validation->set_rules($persona->getRules());
		$this->form_validation->set_rules('fnac','Fecha de Nacimiento', 'callback_validar_fecha');
		$mails = $this->mailCheck();

        if ($this->form_validation->run()){
            $persona->setParams($this->input->post());
			try{
				$this->panel_model->editar('persona', $persona);
				foreach ($mails as $mail){
					$id = $mail->id;
					if(!empty($this->panel_model->existeMail($id))){
						$this->panel_model->editar('email', $mail);
					} else {
						$this->panel_model->addMail($mail);
					}					
				}
				echo "<div class='alert alert-success' role='alert'>La persona se ha editado correctamente!<div>";
			} catch (Exception $e){
				echo "<div class='alert alert-danger' role='alert'>Error, el legajo ingresado ya existe!<div>";
			}
        }else{
			echo "<div class='alert alert-danger' role='alert'>",validation_errors(),"<div>";
        }	
	}
	
	public function getPersona(){
		$this->control();
		$id = $this->input->get('id');
		$data['persona'] = $this->panel_model->getPersona($id);
		$data['email'] = $this->panel_model->getPersonaEmail($id);
		$this->load->view('modifyAjax', $data);
	}

	/*
	** Validadores
	*/
        
	private function mailCheck(){
		$this->control();
		$mails = array();
		if (!empty($this->input->post('mail_laboral'))){
			$this->form_validation->set_rules('mail_laboral', 'Mail Laboral', 'valid_email');
			$mail_laboral = new Email();
			$mail_laboral->direccion = $this->input->post('mail_laboral');
			$mail_laboral->tipoID = 1;
			if ($this->input->post('id_laboral')){
				$mail_laboral->id = $this->input->post('id_laboral');
			} else {
				$mail_laboral->id = NULL;
				$mail_laboral->personaID = $this->input->post('id');
			}
			array_push($mails, $mail_laboral);
		}
		if (!empty($this->input->post('mail_personal'))){
			$this->form_validation->set_rules('mail_personal', 'Mail Personal', 'valid_email');
			$mail_personal = new Email();
			$mail_personal->direccion = $this->input->post('mail_personal');
			$mail_personal->tipoID = 2;
			if ($this->input->post('id_personal')){
				$mail_personal->id = $this->input->post('id_personal');
			} else {
				$mail_personal->id = NULL;
				$mail_personal->personaID = $this->input->post('id');
			}
			array_push($mails, $mail_personal);
		}
		if (!empty($this->input->post('mail_otro'))){
			$this->form_validation->set_rules('mail_otro', 'Otro Mail', 'valid_email');
			$mail_otro = new Email();
			$mail_otro->direccion = $this->input->post('mail_otro');
			$mail_otro->tipoID = 3;
			if ($this->input->post('id_otro')){
				$mail_otro->id = $this->input->post('id_otro');
			} else {
				$mail_otro->id = NULL;
				$mail_otro->personaID = $this->input->post('id');
			}
			array_push($mails, $mail_otro);
		}
		
		switch($this->input->post('principal')){
			case 1:
				$this->form_validation->set_rules('mail_laboral', 'Mail Laboral', 'valid_email|required');
				break;
			case 2:
				$this->form_validation->set_rules('mail_personal', 'Mail Personal', 'valid_email|required');
				break;
			case 3:
				$this->form_validation->set_rules('mail_otro', 'Otro Mail', 'valid_email|required');
				break;
		}
			return $mails;
	}

	public function validar_fecha($str){
		$this->control();
		$patron="/^(\d){4}\-(\d){2}\-(\d){2}$/i";
		if (preg_match($patron,$str)){
				return TRUE;
			}else{
		$this->form_validation->set_message('validar_fecha','Formato de fecha no v&aacute;lido');
		return FALSE;
		}
	}
}
