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

    function devolverEventos($id){
      $select = $this->conexion->prepare('SELECT * FROM eventos  WHERE fk_usuarios = ? '); 
      $select->bind_param("i", $id);
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
      $select = $this->conexion->prepare('SELECT id FROM usuarios WHERE email = ?');
      $select->bind_param("s", $user);
      $select->execute();
      $result = $select->get_result();
      $fila = $result->fetch_assoc();
      
      return $fila ;
    }
    
    function insertData($tabla, $data){
      $sql = 'INSERT INTO '.$tabla.' (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= $key;
        if ($i<count($data)) {
          $sql .= ', ';
        }else $sql .= ')';
        $i++;
      }
      $sql .= ' VALUES (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= $value;
        if ($i<count($data)) {
          $sql .= ', ';
        }else $sql .= ');';
        $i++;
      }
      return $this->ejecutarQuery($sql);
    }

    function consultar($tablas, $campos, $condicion = ""){
      $sql = "SELECT ";
      $result = array_keys($campos);
      $ultima_key = end($result);
      foreach ($campos as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .=" FROM ";
      }
  
      $result = array_keys($tablas);
      $ultima_key = end($result);
      foreach ($tablas as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .= " ";
      }
  
      if ($condicion == "") {
        $sql .= ";";
      }else {
        $sql .= $condicion.";";
      }
      return $this->ejecutarQuery($sql);
    }

    
    function actualizarEvento ($id, $fecha_inicio, $fecha_final, $hora_inicio, $hora_fin){
      $update = $this->conexion->prepare('UPDATE eventos SET fecha_inicio = ?, fecha_fin = ?  WHERE id = ?'); 
      $update->bind_param("ssi", date('Y-m-d',$fecha_inicio), date('Y-m-d',$fecha_final),$id); 
      $update->execute();
    }
    function eliminarEvento($id){
      $delete = $this->conexion->prepare('DELETE FROM eventos WHERE id = ?');
      $delete->bind_param("i", $id);
      $delete->execute();
    }
   

}


?>