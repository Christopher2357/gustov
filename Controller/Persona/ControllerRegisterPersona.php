<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require '../../Models/models_persona.php';
  $persona = new Persona();

  $idPersona = htmlspecialchars($_POST['idPersona'], ENT_QUOTES, 'UTF-8');
  $nombres = htmlspecialchars($_POST['nombres'], ENT_QUOTES, 'UTF-8');
  $apellidos = htmlspecialchars($_POST['apellidos'], ENT_QUOTES, 'UTF-8');
  $correo = htmlspecialchars($_POST['correo'], ENT_QUOTES, 'UTF-8');
  $ci = htmlspecialchars($_POST['ci'], ENT_QUOTES, 'UTF-8');
  $telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES, 'UTF-8');
  $direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8');
  $sexo = htmlspecialchars($_POST['sexo'], ENT_QUOTES, 'UTF-8');

  $consulta = $persona->Registrar_Persona($nombres, $apellidos, $correo, $ci, $telefono, $direccion, $sexo);

  echo $consulta;

} else {

  $response = array('status' => true, 'auth' => false, 'msg' => 'SOLO SE PUEDE POST.' . http_response_code(405), 'data' => '');
  echo json_encode($response);
}

?>