<?php

  require('conector.php');
  $con = $con = new ConectorBD('localhost', 'user_prueba', '123456P');
  
  session_start();

  if ($con->initConexion('agenda')== 'OK'){
    $response['msg']= 'OK' ;
    $fk_usuarios = $con->devolverId($_SESSION['email']); 
    $resultado = $con->consultar(['eventos'],['*'], "WHERE fk_usuarios ='".$fk_usuarios['id']."'",''); 
    $i = 0;
    while($fila = $resultado->fetch_assoc()){
          $response['eventos'][$i]['id'] = $fila['id'];
          $response['eventos'][$i]['title'] = $fila['titulo'];
          $response['eventos'][$i]['start'] =$fila['fecha_inicio'];
        
          $i ++;
      }
  
  
      
    }
    
  
  $con->cerrarConexion();
  echo json_encode($response);


 ?>
