<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("classes/persona.class.php");

class Panel extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        //Helpers
        $this->load->helper('date');
        $this->load->helper('url');

        //Libraries
        //TODO: Parsear templates con las variables de la base de datos
        //$this->load->library('parser');
        $this->load->library('email');
        $this->load->library('pagination');
        $this->load->library('session');

    }

    public function index()
    {
        $data = array();
        $data['user'] = $this->session->userdata();
        $this->load->view('header', $data);
        $this->load->view('index', $data);
        $this->load->view('footer');
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

    public function logout()
    {
        $user_session = array('id', 'username', 'role');
        $this->session->unset_userdata($user_session);
        redirect('panel/index');
    }

    public function doLogin()
    {
        if ($this->input->post()) {

            $this->load->model('panel_model');
            $user = $this->panel_model->userLogin($this->input->post('user'), md5($this->input->post('pass')));

            if ($user) {
                $user_session = array('id' => $user->id, 'username' => $user->username, 'role' => $user->roleID);
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
            $this->load->model('panel_model');
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

    public function system()
    {
        if ($this->session->userdata('username')) {

            $this->load->model('panel_model');

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
        } else {
            $this->session->set_flashdata('warning', "Para acceder al sistema debe estar logueado.");
            redirect('panel/login');
        }
    }

    public function add()
    {
        if ($this->session->userdata('username')) {
            $data = array(
                'error' => $this->session->flashdata('error'),
                'success' => $this->session->flashdata('success'),
                'user' => $this->session->userdata()
            );
            $this->load->view('header', $data);
            $this->load->view('add', $data);
            $this->load->view('footer');
        } else {
            redirect('panel/login');
        }
    }

    public function edit()
    {

        if ($this->session->userdata('username')) {
            $data = array(
                'error' => $this->session->flashdata('error'),
                'success' => $this->session->flashdata('success'),
                'user' => $this->session->userdata()
            );

            $id = $this->input->get('id');
            $this->load->model('panel_model');
            $data['persona'] = $this->panel_model->getPersona($id);
            $data['email'] = $this->panel_model->getPersonaEmail($id);

            if ($data['persona']) {

                $this->load->view('header', $data);
                $this->load->view('modify', $data);
                $this->load->view('footer');
            } else {
                $this->session->set_flashdata('warning', "Error al recuperar los datos. Intente nuevamente!");
                redirect('panel/system');
            }
        } else {
            redirect('panel/login');
        }
    }

    public function delete()
    {
        $id = $this->input->get(id);
    }

    public function search()
    {
        if ($this->session->userdata('username')) {

            $this->load->model('panel_model');

            $data = array(
                'error' => $this->session->flashdata('error'),
                'warning' => $this->session->flashdata('warning'),
                'success' => $this->session->flashdata('success'),
                'user' => $this->session->userdata(),
                'links' => $this->pagination->create_links(),
                'totalCount' => $this->panel_model->recordCount(),
                'personas' => $this->panel_model->search($this->input->post('search')),
                'search' => $this->input->post('search')
            );

            $this->load->view('header', $data);
            $this->load->view('panel', $data);
            $this->load->view('footer');

        } else {
            redirect('panel/login');
        }
    }
}
