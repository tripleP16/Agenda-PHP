<?php
    require ("conector.php");
	session_start();
	$con = new ConectorBD('localhost', 'user_prueba', '123456P'); 
	$id = $_POST["id"];
	echo $id;


 ?>
