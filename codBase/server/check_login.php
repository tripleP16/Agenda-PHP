<?php
    require('conector.php');

    $contrasena = $_POST['password']; 
    $User = $_POST['username'];
    
    
    $con = new ConectorBD('localhost', 'user_prueba', '123456P'); 
    if ($con->initConexion('agenda')== 'OK'){
        $password = $con->devolverContrasena($User); 
        $email = $con->comprobarEmail($User);
        if ($email['email'] != null){
            if (password_verify($contrasena, $password['contrasena'])){
                session_start();
                $_SESSION['email']= $User;
                $response['msg'] = 'OK';
                $_SESSION['isLogin'] = true;
            }else{
                $response['msg'] = 'La contraseña no es correcta';
            }
        }else{
            $response['msg'] = 'El email no existe';
        }
    }else {
        $response['msg'] = 'Error con la base de datos';
    }
    echo json_encode($response); 
    $con->cerrarConexion();
    


 ?>
