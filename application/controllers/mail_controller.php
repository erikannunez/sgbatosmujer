<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("email");
		$this->load->model("panel_model");
        date_default_timezone_set('America/Argentina/Buenos_Aires');
    }
	
	public function saludar(){
		$cumpleaneras = $this->panel_model->getCumpleaneros();
		foreach ($cumpleaneras as $persona){
			$destino = $this->panel_model->getEmailPrincipal($persona);
			$saludo = "Feliz cumpleaños, ".$persona->nombre.". Te deseamos que lo pasas super en tu dia";
			$this->enviarMail($destino->direccion, $saludo);
		}
	}
  
    public function enviarMail($destino, $saludo){
        $configMail = array(
                            'protocol' => 'smtp',
                            'smtp_host' => 'smtp.sendgrid.net',
                            'smtp_port' => 587,
                            'smtp_user' => 'azure_5099f56c9eaf6e8561579143375e1507@azure.com',
                            'smtp_pass' => 'EnvioCorreo2016!',
                            'mailtype' => 'html',
                            'charset' => 'utf-8',
                            'newline' => "\r\n"
                        );  
        $this->email->initialize($configMail);
        $this->email->from('deptomujer@sgbatos.com.ar');
        $this->email->to($destino);
        $this->email->subject('Feliz Cumpleaños!');
        $this->email->message($saludo);
		$this->email->attach('');
        $this->email->send();
        echo "E-mail enviado";
        }   
 }