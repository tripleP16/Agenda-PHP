<?php
    require('conector.php'); 

    $con = new ConectorBD('localhost', 'user_prueba', '123456P');

    if ($con->initConexion('agenda')=='OK') {
        $usuario = new user(1, 'perez@gmail.com', 'Pablo', '160900', '16-09-2000');
        $con->insertUser($usuario);

        echo "TODO OK";

    }else{
        echo "TODO MAL";
    }






 ?>
