<?php
  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require '../../Models/models_persona.php';
    $persona = new Persona();

   $consulta = $persona->listar_Personas();
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

} else {
    
    $response = array('status' => true,'auth' => false,'msg' => 'SOLO SE PUEDE POST.error:405','data'=> $consulta);
    echo json_encode($response);
}

?>