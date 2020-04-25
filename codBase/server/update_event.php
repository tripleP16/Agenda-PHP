<?php
    require('conector.php');
    session_start();
    $response['msg']= "OK";
 $id = $_POST["id"]; 
 $fecha_inicio	='"'.date("Y-m-d",strtotime($_POST['start_date'])).'"'; 
 $hora_inicio	='"'.$_POST['start_hour'].':00"';	
 $fecha_fin	='"'.date("Y-m-d",strtotime($_POST['end_date'])).'"';
 $hora_fin	='"'.$_POST['end_hour'].':00"';
 
 $con = new ConectorBD('localhost', 'user_prueba', '123456P');
 if($con->initConexion('agenda')=='OK'){
     $con->actualizarEvento($id,$fecha_inicio,$fecha_fin,$hora_inicio,$hora_fin);
     $response['msg']= "OK";
 }else{
    $response['msg']= "Error en la conexion con la base de datos";
 }
echo json_encode($response);


 ?>
