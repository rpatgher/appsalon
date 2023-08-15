<?php

namespace Model;

class Servicio extends ActiveRecord{
    // Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['id'] ?? '';
        $this->precio = $args['id'] ?? '';
    }

    public function validar(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El Nombre del Servicio Es Obligatorio';
        }
        if(!$this->precio){
            self::$alertas['error'][] = 'El Precio del Servicio Es Obligatorio';
        }
        if(!is_numeric($this->precio)){
            self::$alertas['error'][] = 'El Precio no Es Válido';
        }

        return self::$alertas;
    }
}
