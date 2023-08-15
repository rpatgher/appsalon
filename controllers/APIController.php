<?php

namespace Controllers;

use Model\CitaServicio;
use Model\Servicio;
use Model\Cita;

class APIController{
    public static function index(){
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardar(){

        // Almacena la cita y devuelve el Id
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        // Almacena la Cita y el Servicio
        $idServicios = explode(',', $_POST['servicios']);

        // Almacena los Servicio con el Id de la Cita
        foreach($idServicios as $idServicio){
            $args = [
                'citaId' => $resultado['id'],
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}