<?php

class Persona
{
    public function setParams($parametros){
        if (isset($parametros['id'])){
            $this->id = $parametros['id'];
        }
        $this->legajo = $parametros['legajo'];
        $this->apellido = $parametros['apellido'];
        $this->nombre = $parametros['nombre'];
        $this->fnac = $parametros['fnac'];
        $this->principal = $parametros['principal'];
    }
	
    public function getRules(){
            $config = array(
                    array(
                        'field'=>'legajo',
                        'label'=>'Legajo',
                        'rules'=>'numeric'
                    ),
                    array(
                        'field'=>'apellido',
                        'label'=>'Apellido',
                        'rules'=>'required'
                    ),
                    array(
                        'field'=>'nombre',
                        'label'=>'Nombre',
                        'rules'=>'required'
                    ),
                    array(
                        'field'=>'fnac',
                        'label'=>'Fecha de nacimiento',
                        'rules'=>'required'
                    ),
                    array(
                        'field'=>'principal',
                        'label'=>'Principal',
                        'rules'=>'in_list[1,2,3]'
                    )
                 );
        return $config;        
    }	
}