<?php

class Email
{
    public function setParams($parametros){
        if (isset($parametros['id'])){
            $this->id = $parametros['id'];
        }
		//$this->id = $parametros['id'];
        $this->direccion = $parametros['direccion'];
        $this->tipoID = $parametros['tipoID'];
        $this->personaID = $parametros['personaID'];
    }
	     
    	
}