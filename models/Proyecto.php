<?php

namespace Model;

class Proyecto extends ActiveRecord{

    public static $tabla = 'proyectos';
    public static $columnasDB = ['id', 'proyecto', 'url', 'usuarioid'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->proyecto = $args['proyecto'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->usuarioid = $args['usuarioid'] ?? '';
    }

    public function validarProyecto(){
        
        if(!$this->proyecto){
            self::$alertas['error'][] = 'El nombre del proyecto es obligatorio';
        }
        
        return self::$alertas;
    }
    
}