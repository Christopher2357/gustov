<?php
  
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require '../../Models/modelo_vacaciones.php';
    $vacations = new Vacaciones;

 $fechaInicio = htmlspecialchars($_POST['fechainicio'], ENT_QUOTES, 'UTF-8');
 $fechaFin = htmlspecialchars($_POST['fechafin'], ENT_QUOTES, 'UTF-8');
if (isset($fechaInicio) && !empty($fechaInicio) && isset($fechaFin) && !empty($fechaFin)) {

      date_default_timezone_set('America/La_Paz');
          $fechaInicio = date($fechaInicio );
          $fechaFin = date($fechaFin);

           $consulta = $vacations->Listar_Vacaciones_filters($fechaInicio,$fechaFin);
        if ($consulta) {
            echo json_encode($consulta);
        }else{
          echo '{
                "sEcho": 1,
                "iTotalRecords": "0",
                "iTotalDisplayRecords": "0",
                "aaData": []
            }';  
        } 

} else {

 $consulta = $vacations->Listar_Vacaciones();
        if($consulta){
            echo json_encode($consulta);
        }else{
            echo '{
                "sEcho": 1,
                "iTotalRecords": "0",
                "iTotalDisplayRecords": "0",
                "aaData": []
            }';
        }

}

} else {
    
    $response = array('status' => true,'auth' => false,'msg' => 'SOLO SE PUEDE POST.error:405','data'=> '');
    echo json_encode($response);
}

?>