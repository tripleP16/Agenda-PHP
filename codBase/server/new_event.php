<?php
    require('conector.php');
    session_start();
    $data['titulo'] = '"'.$_POST['titulo'].'"';
    $data['fecha_inicio'] = '"'.$_POST['start_date'].'"';
    $data['hora_inicio'] = '"'.$_POST['start_hour'].':00"';/*Add ":00" to fill datetime format*/
    $data['fecha_fin'] = '"'.$_POST['end_date'].'"';
    $data['hora_fin'] = '"'.$_POST['end_hour'].':00"'; /*Add ":00" to fill datetime format*/
    $data['completo'] = $_POST['allDay'];

    
    $con = new ConectorBD('localhost', 'user_prueba', '123456P');
    $response['msg'] = "OK";
    
    if($con->initConexion('agenda')=='OK'){
       
        $id = $con->devolverId($_SESSION['email']);
        $data['fk_usuarios'] = '"'.$id['id'].'"';
        if($con->insertData('eventos', $data))
        $response['msg'] = "OK";

    }else{
        $response['msg'] = "No se pudo conectar con la base de datos";
    }


    echo json_encode($response);
    $con->cerrarConexion();

 ?>
