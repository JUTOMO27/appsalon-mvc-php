<?php

namespace Model;

class Usuario extends ActiveRecord{
    //Base de datos

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','nombre','apellido','email','password','telefono','admin','confirmado','token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args=[]){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    //Mensaje de validación para la creación de la cuenta
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->apellido){
            self::$alertas['error'][] = 'El apellido es obligatorio';
        }
        if(!$this->telefono){
            self::$alertas['error'][] = 'El teléfono es obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][] = 'El e-mail es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        if(strlen($this->password) < 6 && strlen($this->password) > 0){
            self::$alertas['error'][] = 'La contraseña debe contener al menos 6 carácteres';
        }

        return self::$alertas;
    }

    //Validar Login
    public function validarLogin(){
        //Verificar si existe el correo
        $usuario = Usuario::where('email', $this->email);
        if(!$usuario && !empty($this->email)){
            self::$alertas['info'][] = '<a href="/crear-cuenta">Este E-mail no está registrado, puedes crear una cuenta aquí</a>';
        }

        //Error por falta de campos
        if(!$this->email){
            self::$alertas['error'][] = 'El e-mail es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }

        return self::$alertas;
    }

    public function validarEmail(){
        //Verificar si existe el correo
        $usuario = Usuario::where('email', $this->email);
        if(!$usuario && !empty($this->email)){
            self::$alertas['info'][] = '<a href="/crear-cuenta">Este E-mail no está registrado, puedes crear una cuenta aquí</a>';
        }

        //Error por falta de campos
        if(!$this->email){
            self::$alertas['error'][] = 'El e-mail es obligatorio';
        }

        return self::$alertas;
    }

    public function validarPassword(){
        if(!$this->password){
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }

        if(strlen($this->password) < 6 && strlen($this->password) > 0){
            self::$alertas['error'][] = 'La contraseña debe contener al menos 6 carácteres';
        }
        return self::$alertas;
    }

    //Revisa si el usuario existe
    public function existeUsuario(){
        $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        
        $resultado = self::$db->query($query);

        if($resultado->num_rows){
            self::$alertas['info'][] = '<a href="/olvide">Este E-mail ya se ha registrado, si has olvidado tu contraseña puedes recuperarla aquí</a>';
        }

        return $resultado;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = uniqid();
    }   

    public function comprobarPasswordAndVerificado($password){
        $resultado = password_verify($password, $this->password);
        if (!$resultado) {
            self::$alertas['error'][] = 'La contraseña es incorrecta';
            return false;
        } 
    
        if (!$this->confirmado) {
            self::$alertas['info'][] = 'Todavia no has confirmado tu cuenta, revisa tu correo para confirmarla';
            return false;
        }

        return true;
    }
}
?>