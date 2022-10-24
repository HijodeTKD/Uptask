<?php

namespace Model;

class Usuario extends ActiveRecord{

    //Table structure
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];


    //Construct object with table structure
    public function __construct($args = []){ //With $args = [] can declare an user with values directly new Usuario($_POST)

        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';

        //Not a key from DB, only for validation
        $this->password2 = $args['password2'] ?? '';
        $this->passwordActual = $args['passwordActual'] ?? '';
        $this->passwordNuevo = $args['passwordNuevo'] ?? '';

        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    public function validateNewAccount(){

        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre de usuario es obligatorio';
        }

        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'El email debe ser válido';
        }

        //Minimal password security //Returns true/false
        $uppercase = preg_match('@[A-Z]@', $this->password);
        $lowercase = preg_match('@[a-z]@', $this->password);
        $number    = preg_match('@[0-9]@', $this->password);
        //$specialChars = preg_match('@[^\w]@', $this->password);

        if(!$this->password){
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }else if(strlen($this->password) < 8){
            self::$alertas['error'][] = 'La contraseña debe tener al menos 8 caracteres';
        }else if(!$uppercase){
            self::$alertas['error'][] = 'La contraseña debe tener al menos una mayúscula';
        }else if(!$lowercase){
            self::$alertas['error'][] = 'La contraseña debe tener al menos una minúscula';
        }else if(!$number){
            self::$alertas['error'][] = 'La contraseña debe tener al menos un número';
        }

        if($this->password !== $this->password2){
            self::$alertas['error'][] = 'Las contraseñas no coinciden';
        }

        return self::$alertas;
    }
    //Check if password introduced matches with db password
    public function comprobarPassword() :bool{
        return password_verify($this->passwordActual, $this->password);
    }

    //Hash password
    public function hashPassword() :void{
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    //Generate new token
    public function crearToken() :void{
        $this->token = md5(uniqid());//md5 change a value for a static code(hola = uweqwsaerase hola buenas = uweqwsaerase iajsdnsjaeedewas), uniqid generates a 15 random characters, if we use both methods at time, it generates a stronger code.
    }

    //Validate Email
    public function validarEmail(){

        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'El email no es válido';
        }
        
        return self::$alertas;
    }

    //Validate password (Reestablecer)
    public function validarPassword(){
        //Minimal password security //Returns true/false
        $uppercase = preg_match('@[A-Z]@', $this->password);
        $lowercase = preg_match('@[a-z]@', $this->password);
        $number    = preg_match('@[0-9]@', $this->password);
        //$specialChars = preg_match('@[^\w]@', $this->password);

        if(!$this->password){
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }else if(strlen($this->password) < 8){
            self::$alertas['error'][] = 'La contraseña debe tener al menos 8 caracteres';
        }else if(!$uppercase){
            self::$alertas['error'][] = 'La contraseña debe tener al menos una mayúscula';
        }else if(!$lowercase){
            self::$alertas['error'][] = 'La contraseña debe tener al menos una minúscula';
        }else if(!$number){
            self::$alertas['error'][] = 'La contraseña debe tener al menos un número';
        }

        if($this->password !== $this->password2){
            self::$alertas['error'][] = 'Las contraseñas no coinciden';
        }

        return self::$alertas;
    }

    public function validarLogin(){

        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'El email no es válido';
        }
        
        if(!$this->password){
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }

        return self::$alertas;
    }

    public function validarPerfil(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if(!$this->passwordActual){
            self::$alertas['error'][] = 'El password actual es necesario para guardar modificar datos';
        }

        //Minimal password security //Returns true/false
        $uppercase = preg_match('@[A-Z]@', $this->password);
        $lowercase = preg_match('@[a-z]@', $this->password);
        $number    = preg_match('@[0-9]@', $this->password);


        //If user wants a new password, check if is secure
        if($this->passwordNuevo){
            if(strlen($this->passwordNuevo) < 8){
                self::$alertas['error'][] = 'La contraseña debe tener al menos 8 caracteres';
            }else if(!$uppercase){
                self::$alertas['error'][] = 'La contraseña debe tener al menos una mayúscula';
            }else if(!$lowercase){
                self::$alertas['error'][] = 'La contraseña debe tener al menos una minúscula';
            }else if(!$number){
                self::$alertas['error'][] = 'La contraseña debe tener al menos un número';
            }
        }

        return self::$alertas;
    }

    public function nuevoPassword():array{

        if(!$this->passwordActual){
            self::$alertas['error'][] = 'Introduce tu contraseña actual';
        }

        //Minimal password security //Returns true/false
        $uppercase = preg_match('@[A-Z]@', $this->password);
        $lowercase = preg_match('@[a-z]@', $this->password);
        $number    = preg_match('@[0-9]@', $this->password);
        //$specialChars = preg_match('@[^\w]@', $this->password);

        if(!$this->passwordNuevo){
            self::$alertas['error'][] = 'Introduce tu nueva contraseña';
        }else if(strlen($this->password) < 8){
            self::$alertas['error'][] = 'Tu nueva contraseña debe tener al menos 8 caracteres';
        }else if(!$uppercase){
            self::$alertas['error'][] = 'Tu nueva contraseña debe tener al menos una mayúscula';
        }else if(!$lowercase){
            self::$alertas['error'][] = 'Tu nueva contraseña debe tener al menos una minúscula';
        }else if(!$number){
            self::$alertas['error'][] = 'Tu nueva contraseña debe tener al menos un número';
        }

        return self::$alertas;
    }
}