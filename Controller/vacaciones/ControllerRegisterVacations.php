<?php
  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require '../../Models/modelo_vacaciones.php';
    $vacations = new Vacaciones;

     $idempleado = htmlspecialchars($_POST['idempleado'],ENT_QUOTES,'UTF-8');
     $diadisponibleactual = htmlspecialchars($_POST['diadisponibleactual'],ENT_QUOTES,'UTF-8');
     $fechainicio = htmlspecialchars($_POST['fechainicio'],ENT_QUOTES,'UTF-8');
     $fechafinal = htmlspecialchars($_POST['fechafinal'],ENT_QUOTES,'UTF-8');
     $descrition = htmlspecialchars($_POST['descrition'],ENT_QUOTES,'UTF-8');
      $diasselecionados = htmlspecialchars($_POST['diasselecionados'],ENT_QUOTES,'UTF-8');
    
    $consulta = $vacations->Registrar_Vacaciones_Empleado($idempleado,$diadisponibleactual,$fechainicio,$fechafinal,$descrition,$diasselecionados);
        echo $consulta;
    
} else {
    
    $response = array('status' => true,'auth' => false,'msg' => 'SOLO SE PUEDE POST.error:405','data'=> '');
    echo json_encode($response);
}
?>