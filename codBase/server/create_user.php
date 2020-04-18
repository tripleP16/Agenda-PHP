<?php
    require('conector.php'); 
    require('user.php');

    $con = new ConectorBD('localhost', 'user_prueba', '123456P');

    if ($con->initConexion('agenda')=='OK') {
        echo "TODO OK";

    }else{
        echo "TODO MAL";
    }






 ?>
