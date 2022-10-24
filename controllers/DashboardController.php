<?php

namespace Controllers;

use Model\Proyecto;
use Model\Usuario;
use MVC\Router;

class DashboardController{

    public static function index(Router $router){

        session_start();
        isAuth();

        $id = $_SESSION['id'];

        $proyectos =  Proyecto::belongsTo('usuarioid', $id);
        
        $router->render('dashboard/index', [
            'titulo' => 'Proyectos',
            'proyectos' => $proyectos
        ]);
    }

    public static function crearProyecto(Router $router){

        session_start();
        isAuth();

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $proyecto = new Proyecto($_POST);

            //Validate project
            $alertas = $proyecto->validarProyecto();

            if(empty($alertas)){
                //Generate uniq URL 
                $hash = md5(uniqid());
                $proyecto->url = $hash;

                //Identify creator user
                $proyecto->usuarioid = $_SESSION['id'];

                //Save project
                $proyecto->guardar();

                //Redirect
                header('Location: /proyecto?url=' . $proyecto->url);
            }
        }

        $alertas = Proyecto::getAlertas();
        
        $router->render('dashboard/crear-proyecto', [
            'titulo' => 'Crear Proyecto',
            'alertas' => $alertas
        ]);
    }

    public static function proyecto(Router $router){

        session_start();
        isAuth();
        
        //Get project url
        $projectUrl = $_GET['url'];
        if(!$projectUrl) header('Location: /dashboard');

        //Check if user is the project creator
        $proyecto = Proyecto::where('url', $projectUrl);

        //If not, redirect
        if($proyecto->usuarioid !== $_SESSION['id']){
            header('Location: /dashboard');
        }

        $router->render('dashboard/proyecto', [
            'titulo' => $proyecto->proyecto
        ]);
    }

    public static function perfil(Router $router){

        session_start();
        isAuth();

        $alertas = [];
        $usuario = Usuario::find($_SESSION['id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if($usuario->email === $_POST['email'] && $usuario->nombre === $_POST['nombre'] && !$_POST['passwordNuevo']){
                Usuario::setAlerta('error', 'Sin cambios que guardar');
            }else{
                $usuario->sincronizar($_POST);

                //Check is required fields are filled
                $alertas = $usuario->validarPerfil();

                if(empty($alertas) && $usuario->passwordActual){
                    $passwordCorrecto = $usuario->comprobarPassword();
                    $existeUsuario = Usuario::where('email', $usuario->email);

                    if(!$passwordCorrecto){
                        Usuario::setAlerta('error', 'El contraseña actual introducida no es correcta');
                    }else if($existeUsuario && $existeUsuario->id !== $usuario->id){ //If introduced email exists in DB (Not own email)...
                        //Error, an user exists with that email
                        Usuario::setAlerta('error', 'Email ya registrado en Uptask');
                    }else{
                        //Set new password if user introduces new one
                        if($usuario->passwordNuevo){
                            $usuario->password = $usuario->passwordNuevo;
                            $usuario->hashPassword();
                        }

                        //Save user
                        $usuario->guardar();
                        Usuario::setAlerta('exito', 'Guardado Correctamente');

                        //Asignar el nombre de nuevo a la barra
                        $_SESSION['nombre'] =  $usuario->nombre;
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        $router->render('dashboard/perfil', [
            'titulo' => 'Perfil',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
}