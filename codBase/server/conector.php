<?php 
require('user.php');
date_default_timezone_set('America/Caracas');

class ConectorBD{
    private $host;
    private $user;
    private $password;
    private $conexion;

    function __construct($host, $user, $password){
      $this->host = $host;
      $this->user = $user;
      $this->password = $password;
    }

    function ejecutarQuery($query){
        return $this->conexion->query($query);
      }

    function initConexion($nombre_db){
      $this->conexion = new mysqli($this->host, $this->user, $this->password, $nombre_db);
      if ($this->conexion->connect_error) {
        return "Error:" . $this->conexion->connect_error;
      }else {
        return "OK";
      }
    }

    function insertUser($usuario){
        $insert = $this->conexion->prepare('INSERT INTO usuarios (id, nombre, email, contrasena, fecha_nac) VALUES (?,?,?,?,?)');
        $insert->bind_param("issss", $usuario->getID(), $usuario->getNombre(), $usuario->getEmail(), password_hash($usuario->getContrasena(), PASSWORD_DEFAULT), date('Y-m-d',$usuario->getFecha_Nac()));
        $insert->execute();
    }

    function devolverContrasena($email){
      $select = $this->conexion->prepare('SELECT contrasena FROM usuarios  WHERE email = ? '); 
      $select->bind_param("s", $email);
      $select->execute();
      $result = $select->get_result();
      $fila = $result->fetch_assoc();
      
      return $fila ;
    }

    function cerrarConexion(){
      $this->conexion->close();
    }


    function comprobarEmail($email){
      $select = $this->conexion->prepare('SELECT email FROM usuarios  WHERE email = ? '); 
      $select->bind_param("s", $email);
      $select->execute();
      $result = $select->get_result();
      $fila = $result->fetch_assoc();
      
      return $fila ;
    }

    function devolverId($user){
      
    }

}


?>