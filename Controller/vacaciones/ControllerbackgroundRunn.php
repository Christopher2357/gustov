<?php
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   require '../../Models/modelo_vacaciones.php';
    $vacacion = new Vacaciones;

  $consulta = $vacacion->Personal_Vacaciones_backgroundRunn();

    date_default_timezone_set('America/La_Paz');
     
     $fechaActual = date('Y-m-d');
     
    if (isset($consulta)) {

        foreach ($consulta as   $elemt) {

            if ($elemt["fechafinal"] <= $fechaActual) {

               $request= $vacacion->Listar_Empleados_Cambiar_Estado( $elemt["idempleado"],"Trabajo");
            }else{
                $request = 0 ;
            }
        }
    }
      if (isset($request)) {

  echo json_encode($request);
} else {

  echo json_encode($consulta);
}   

} else {
    
    $response = array('status' => true,'auth' => false,'msg' => 'SOLO SE PUEDE POST.error:405','data'=> $consulta);
    echo json_encode($response);
}
?>