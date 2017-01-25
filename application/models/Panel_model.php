<?php

class Panel_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

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
        $this->db->select('email.id, email.direccion, email.tipoID, email.personaID, email.principal, tipoemail.tipo as tipo');
        $this->db->from('email');
        $this->db->join('tipoemail', 'email.tipoID = tipoemail.id', 'left');
        $this->db->order_by('email.tipoID', 'desc');
        $this->db->where('personaID', $id);

        $query = $this->db->get();

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

    public function addPersona(Persona $persona){

        $persona_data = array(
            'id' => $persona->getId(),
            'legajo' => $persona->getLegajo(),
            'apellido' => $persona->getApellido(),
            'nombre' => $persona->getNombre(),
            'fnac' => $persona->getFechaNac()
        );

        $this->db->insert("persona", $persona_data);

        $persona->setId($this->db->insert_id());

        foreach($persona->getEmails() as $key => $value){

            $email_data = array(
                'id' => NULL,
                'direccion' => $value['direccion'],
                'tipoID' => $key,
                'personaID' => $persona->getId(),
                'principal' => $value['principal']
            );

            $this->db->insert("email", $email_data);
        }

    }

    public function recordCount()
    {
        return $this->db->count_all("persona");
    }
}