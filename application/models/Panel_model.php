<?php

class Panel_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	
	/*
	** Control de sesión y recuperación de password
	*/
	
    public function userLogin($username, $password)
    {

        $this->db->select('id, username, roleID');
        $this->db->from('system_users');
        $this->db->where('username', $username);
        $this->db->where('pass', $password);

        $query = $this->db->get();

        return $query->row();
    }

    public function userRecover($email)
    {
        $this->db->select('*');
        $this->db->from('system_users');
        $this->db->where('mail', $email);

        $query = $this->db->get();

        return $query->row();
    }

	/*
	** Búsquedas y listados
	*/	
	
    public function fetchPersonas($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->order_by("apellido", "asc");
        $query = $this->db->get("persona");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
    public function search($key, $limit = NULL, $start = NULL)
    {
        $this->db->select('*');
        $this->db->from('persona');
        $this->db->like('legajo', $key);
        $this->db->or_like('apellido', $key);
        $this->db->or_like('nombre', $key);
        if (!is_null($limit) && !is_null($start)) {
            $this->db->limit($limit, $start);
        }
        $this->db->order_by('apellido', 'asc');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	/*
	** Getters
	*/

    public function getPersona($id)
    {
        $this->db->select('*');
        $this->db->from('persona');
        $this->db->where('id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getPersonaEmail($id)
    {
		$this->db->select('id, direccion, tipoID, personaID');
		$this->db->from('email');
		$this->db->where('personaID', $id);
        $consulta = $this->db->get();
        return $consulta->result();
    }
	
	public function getEmailPrincipal($persona){
		$this->db->select('direccion');
		$this->db->from('email');
		$this->db->where('personaID', $persona->id);
		$this->db->where('tipoID', $persona->principal);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
		return $resultado;		
	}
	
	public function getLegajo($legajo){
		$this->db->select('id');
		$this->db->from('persona');
		$this->db->where('legajo', $legajo);
        $consulta = $this->db->get();
        return $consulta->result();
	}
	
	public function getCumpleaneros(){
		$hoy = date('m-d');
		$this->db->select('*');
		$this->db->from('persona');
		$this->db->like('fnac', $hoy);
        $consulta = $this->db->get();
        return $consulta->result();
	}
	
	/*
	** Altas, Bajas y Ediciones
	*/	
	
    public function editar($tabla, $dato){
        $this->db->where('id', $dato->id);
        $this->db->update($tabla, $dato);
    }

    public function addPersona($persona){
		$controlPersona = $this->getLegajo($persona->legajo);
		if (!empty($controlPersona) && ($persona->legajo != 0)){
				throw new Exception('El legajo ya existe');
		}
		$this->db->insert('persona', $persona);
		$lastID = $this->db->insert_id();
		return $lastID;
    }
	
	public function addMail($mail){
		$this->db->insert('email', $mail);
	}
	
    public function borrarUsuario($id){
		$controlPersona = $this->existePersona($id);
		if (empty($controlPersona)){
			throw new Exception('La persona no existe');
		}
        $this->db->where('id', $id);
        $this->db->delete('persona');
		$this->borrarMails($id);
    }
	
	public function borrarMails($idPersona){
			$this->db->where('personaID', $idPersona);
			$this->db->delete('email');
	}
	
	public function eliminarMail($mailID){
		//Debería recibir el id de la persona
		//Entonces where('personaID', $personaID);
		$this->db->where('id', $mailID);
		$this->db->delete('email');		
	}

	/*
	** Controles
	*/	
	
	public function existePersona($id){
		$this->db->select('id');
		$this->db->from('persona');
		$this->db->where('id', $id);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
		return $resultado;
	}
	
	public function existeMail($id){
		$this->db->select('id');
		$this->db->from('email');
		$this->db->where('id', $id);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
		return $resultado;
	}

	/*
	** Auxiliares
	*/		
	
    public function recordCount(){
        return $this->db->count_all("persona");
    }
}