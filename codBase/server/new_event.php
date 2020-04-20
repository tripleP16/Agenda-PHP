<?php
    session_start();
    $response['msg']= $_SESSION['email'];
    echo json_encode($response);


 ?>
