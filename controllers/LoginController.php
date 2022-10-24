<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {

    public static function login(Router $router){
        $squares= true;
        $alertas = [];
        $usuario =  new Usuario;

        //Identify HTTP referer for CSS gradient effect
        $desde = $_SERVER["HTTP_REFERER"] ?? 'http://localhost:3000/';
        $bgcolorfrom = from($desde);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarLogin();

            if(empty($alertas)){
                //User exist?
                $usuario = Usuario::where('email', $usuario->email);

                if(!$usuario){
                    Usuario::setAlerta('error', 'El usuario no existe');
                }else if(!$usuario->confirmado){
                    Usuario::setAlerta('error', 'El usuario no esta confirmado');
                }else{
                    //User exist and is checked
                    if(password_verify($_POST['password'], $usuario->password)){

                        //Session starts with following info
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //Redirect
                        header('Location: /dashboard');
                    }else{
                        Usuario::setAlerta('error', 'La contraseña es incorrecta');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();

        //Render view
        $router->render('auth/login', [
            'titulo' => 'Iniciar sesión',
            'bgcolorfromto' => $bgcolorfrom . 'tocyan',
            'bgcolor' => 'cyan',
            'alertas' => $alertas,
            'usuario' => $usuario,
            'squares' => $squares
        ]);
    }

    public static function logout(){
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
    
    public static function crear(Router $router){
        
        $squares= true;
        $usuario = new Usuario;
        $alertas = [];

        //Identify HTTP referer for CSS gradient effect
        $desde = $_SERVER["HTTP_REFERER"] ?? 'http://localhost:3000/';
        $bgcolorfrom = from($desde);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $usuario->sincronizar($_POST); 
            $alertas = $usuario->validateNewAccount();

            if(empty($alertas)){

                $existeUsuario = Usuario::where('email', $usuario->email);

                if($existeUsuario){
                    Usuario::setAlerta('error', 'El usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                }else{
                    //Hash password
                    $usuario->hashPassword();

                    //Generate token
                    $usuario->crearToken();

                    //Save the new user
                    $resultado = $usuario->guardar();

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    //Redirect
                    if($resultado){
                        header('Location: /mensaje');
                    }
                }
            }
        }

        //Render view
        $router->render('auth/crear', [
            'titulo' => 'Crear cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas,
            'bgcolorfromto' => $bgcolorfrom . "topurple",
            'bgcolor' => 'purple',
            'squares' => $squares
        ]);
    }

    public static function olvide(Router $router){

        $squares= true;
        $alertas = [];

        //Identify HTTP referer for CSS gradient effect
        $desde = $_SERVER["HTTP_REFERER"] ?? 'http://localhost:3000/';
        $bgcolorfrom = from($desde);
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $usuario = new Usuario($_POST);

            $alertas = $usuario->validarEmail();
            
            if(empty($alertas)){
                //Find user
                $usuario = Usuario::where('email', $usuario->email);
                
                if($usuario && $usuario->confirmado){
                    //Generate new token
                    $usuario->crearToken();
                    
                    //Update User
                    $usuario->guardar();
                    
                    //Send email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();
                    
                    //Show success Alert
                    Usuario::setAlerta('exito', 'Se han enviado las instrucciones para reestablecer tu contraseña a tu email');
                }else{
                    Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        //Render view
        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi password',
            'bgcolorfromto' => $bgcolorfrom . "toorange",
            'bgcolor' => 'orange',
            'alertas' => $alertas,
            'squares' => $squares
        ]);
    }

    public static function reestablecer(Router $router){


        $squares= true;
        $alertas = [];
        $mostrar = true;
        $passChanged = false;

        //Identify HTTP referer for CSS gradient effect
        $desde = $_SERVER["HTTP_REFERER"] ?? 'http://localhost:3000/';
        $bgcolorfrom = from($desde);
        
        //Without a valid token, redirect
        $token = s($_GET['token']);
        if(!$token) header('Location: /');

        //Find user by token
        $usuario = Usuario::where('token', $token);

        //Can't find a user, shows alert and hides form
        if(empty($usuario)){
            $mostrar = false;
            Usuario::setAlerta('error', 'Token no válido');
        }


        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if(!$usuario) header('Location: /'); //Prevents to error if recharge post submit without info

            //Add new password
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarPassword();

            if(empty($alertas)){
                //Hash new password
                $usuario->hashPassword();

                //Remove Token
                $usuario->token = null;

                //Save in DB
                $usuario->guardar();

                //Show success alert
                Usuario::setAlerta('exito', 'Contraseña reestablecida correctamente');
                $passChanged = true;
                $mostrar = false;
            }
        }

        $alertas = Usuario::getAlertas();

        //Render view
        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer contraseña',
            'bgcolor' => 'orangeyellow',
            'bgcolorfromto' => $bgcolorfrom . "toorangeyellow",
            'mostrar' => $mostrar,
            'alertas' => $alertas,
            'passChanged' => $passChanged,
            'squares' => $squares
        ]);
    }

    public static function mensaje(Router $router){

        $squares= true;

        //Identify HTTP referer for CSS gradient effect
        $desde = $_SERVER["HTTP_REFERER"] ?? 'http://localhost:3000/';
        $bgcolorfrom = from($desde);

        //Render view
        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta creada',
            'bgcolorfromto' => $bgcolorfrom . "togreenyellow",
            'bgcolor' => 'greenyellow',
            'squares' => $squares
        ]);
    }

    public static function confirmar(Router $router){

        $squares= true;
        $alertas = [];
        $confirmado = false;

        //Sanitize token
        $token = s($_GET['token']);
        
        //If don't get a token, returns to main page
        if(!$token)header('Location: /');

        //Find the token in DB and get user data
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){

            Usuario::setAlerta('error', 'Token No Valido');

        }else{
            //Confirm user
            $usuario->confirmado = "1";
            //Delete token
            $usuario->token = null;
            //Save user
            $usuario->guardar();
            //Shows success alert
            Usuario::setAlerta('exito', 'Bienvenido '. $usuario->nombre .' tu cuenta se ha activado correctamente');
            //Show link
            $confirmado = true;
        }
        
        $alertas = Usuario::getAlertas();
        
        //Render view
        $router->render('auth/confirmar', [
            'titulo' => 'Cuenta confirmada',
            'bgcolor' => 'green',
            'alertas' => $alertas,
            'confirmado' => $confirmado,
            'squares' => $squares
        ]);
    }
}