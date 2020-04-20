<?php
    require('conector.php'); 

    date_default_timezone_set('America/Caracas');

    $con = new ConectorBD('localhost', 'user_prueba', '123456P');

    if ($con->initConexion('agenda')=='OK') {
        $usuario = new user(1, 'perez@gmail.com', 'Pablo Miguel Perez Perez', '160900', '2000-09-16');
        $usuario2 = new user(2, 'rodmapeji@gmail.com', 'Rodolfo Mariano Perez Jimenez', '15858', '1956-11-01');
        $usuario3 = new user(3, 'palcoper@gmail.com', 'Palmira Coromoto Perez Ochoa', '852P0', '1961-06-24');
        echo "<p>". date('Y-m-d',$usuario->getFecha_Nac()) . "</p>";
        $con->insertUser($usuario);
        $con->insertUser($usuario2);
        $con->insertUser($usuario3);

       

        echo "TODO OK";

    }else{
        echo "TODO MAL";
    }



 $con->cerrarConexion();


 ?>
