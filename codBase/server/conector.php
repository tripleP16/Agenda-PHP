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
        $insert = $this->conexion->prepare('INSERT INTO usuarios (id, nombre, email, contrasena, fecha_nac) VALUES (?,?,?,?,?)');
        $insert->bind_param("isssi", $usuario->getID(), $usuario->getNombre(), $usuario->getEmail(), $usuario->getContrasena(), date('y-m-d',$usuario->getFecha_Nac()));
        $insert->execute();
    }
}


?>