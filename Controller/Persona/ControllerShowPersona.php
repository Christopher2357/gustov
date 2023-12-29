<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    require '../../Models/models_persona.php';
    $persona = new Persona();

    $idpersona = htmlspecialchars($_POST['idpersona'], ENT_QUOTES, 'UTF-8');

    $consulta = $persona->Show_Persona($idpersona);

    $response = array('status' => true, 'auth' => true, 'msg' => '', 'data' => $consulta);
    echo json_encode($response);

} else {

    $response = array('status' => true, 'auth' => false, 'msg' => 'SOLO SE PUEDE POST.error:405', 'data' => '');
    echo json_encode($response);
}

?>