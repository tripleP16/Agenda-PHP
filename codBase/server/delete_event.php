<?php
    require ("conector.php");
	session_start();
	$con = new ConectorBD('localhost', 'user_prueba', '123456P'); 
	
	$id = $_POST["id"];
	if ($con->initConexion('agenda')== 'OK'){
		$con->eliminarEvento($id);
		$response['msg']= 'OK' ;
	}else{
		$response['msg']= 'Error con la base de datos' ;
	}
	echo json_encode($response);


 ?>
