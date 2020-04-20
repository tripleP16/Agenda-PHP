<?php 
     date_default_timezone_set('America/Caracas');
    class user {
        private $id;
        private $email;
        private $nombre; 
        private $contrasena; 
        private $fecha_nac; 

        function __construct($id, $email, $nombre, $contrasena, $fecha_nac)
        {
            $this->id = $id; 
            $this->email = $email;
            $this->nombre = $nombre; 
            $this->contrasena = $contrasena;
            $this->fecha_nac = strtotime($fecha_nac);   

        }

        function getID(){
            return $this->id;
        }

        function getEmail(){
            return $this->email;
        }

        function getNombre(){
            return $this->nombre;
        }

        function getContrasena(){
            return $this->contrasena;
        }

        function getFecha_Nac(){
            return $this->fecha_nac;
        }
    }


?>