<?php

namespace Controllers;

use Model\Proyecto;
use Model\Tarea;

class TareaController{

    public static function index(){
        $proyectourl = $_GET['url'];

        if(!$proyectourl) header('Location: /dashboard');
        
        session_start();

        $proyecto = Proyecto::where('url', $proyectourl);

        //If project not found or User are not the project propietary...

        if(!$proyecto || $proyecto->usuarioid !== $_SESSION['id']){
            header('Location: /404');
        }

        $tareas = Tarea::belongsTo('proyectoid', $proyecto->id);

        echo json_encode(['tareas' => $tareas]);
    }

    public static function crear(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            session_start();

            $proyectoid = $_POST['proyectoid']; //From JS, datos fetch
            $proyecto = Proyecto::where('url', $proyectoid);

            //Url not found or Project not own at user - Error
            if(!$proyecto || $proyecto->usuarioid !== $_SESSION['id']){
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al agregar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }

            //Success
            $tarea = new Tarea($_POST);
            $tarea->proyectoid = $proyecto->id;
            $resultado = $tarea->guardar();
            $respuesta = [
                'tipo' => 'exito',
                'id' => $resultado['id'],
                'mensaje' => 'tarea agregada correctamente',
                'proyectoid' => $proyecto->id
            ];

            echo json_encode($respuesta);
        }
    }

    public static function actualizar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $proyecto = Proyecto::where('url', $_POST['proyectoid']);

            session_start();
            
            //Url not found or Project not own at user - Error
            if(!$proyecto || $proyecto->usuarioid !== $_SESSION['id']){
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al actualizar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }

            //Success
            $tarea = new Tarea($_POST);
            $tarea->proyectoid = $proyecto->id;
            $resultado = $tarea->guardar();

            if($resultado){
                $respuesta = [
                    'tipo' => 'exito',
                    'id' => $tarea->id,
                    'proyectoid' => $proyecto->id,
                    'mensaje' => 'Actualizado correctamente'
                ];

                echo json_encode(['respuesta' => $respuesta]);
            }
        }
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $proyecto = Proyecto::where('url', $_POST['proyectoid']);

            session_start();
            
            //Url not found or Project not own at user - Error
            if(!$proyecto || $proyecto->usuarioid !== $_SESSION['id']){
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al actualizar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }

            //Success
            $tarea = new Tarea($_POST);

            $resultado = $tarea->eliminar();
            $resultado = [
                'resultado' => $resultado,
                'tipo' => 'exito',
                'mensaje' => 'Tarea eliminada correctamente'
            ];

            echo json_encode($resultado);
        }
    }
}