<?php

namespace Model;

class Servicio extends ActiveRecord{
    //Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id','nombre','precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    public function validar(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'Debes añadirle un nombre a tu servicio';
        }
        if(!$this->precio){
            self::$alertas['error'][] = 'Debes añadirle un precio a tu servicio';
        }
        if(!empty($this->precio) && !is_numeric($this->precio)){
            self::$alertas['error'][] = 'El precio debe ser un numero';
        }
        return self::$alertas;
    }
}

