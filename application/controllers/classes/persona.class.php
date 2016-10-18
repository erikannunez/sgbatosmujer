<?php

class Persona{

    private $id;
    private $legajo;
    private $apellido;
    private $nombre;
    private $fechaNac;
    private $emails;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLegajo()
    {
        return $this->legajo;
    }

    /**
     * @param mixed $legajo
     */
    public function setLegajo($legajo)
    {
        $this->legajo = $legajo;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getFechaNac()
    {
        return $this->fechaNac;
    }

    /**
     * @param mixed $fechaNac
     */
    public function setFechaNac($fechaNac)
    {
        $this->fechaNac = $fechaNac;
    }

    /**
     * @return mixed
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * @param mixed $emails
     */
    public function setEmails($emails)
    {
        $this->emails = $emails;
    }


}