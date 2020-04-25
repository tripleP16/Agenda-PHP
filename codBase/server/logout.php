<?php

    $response['msg']= "OK";
    session_start();
	session_destroy();
	header("location: ../client/index.html");
    echo json_encode($response);

 ?>
