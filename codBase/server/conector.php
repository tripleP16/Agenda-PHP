<?php 
require('user.php');
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
        $sql = 'INSERT INTO usuarios VALUES('. $usuario->getEmail() . ' , ' . $usuario->getNombre() . ' , '.$usuario->getContrasena(). ' , '. $usuario->getFecha_Nac() . ');';
        return $this->ejecutarQuery($sql);
    }
}


?>