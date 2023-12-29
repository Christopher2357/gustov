<?php

class Persona{
    private $conexion;
    function __construct(){
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }
        
function Registrar_Persona($nombres,$apellidos,$correo,$ci,$telefono,$direccion,$sexo){

	  // Verificar si el usuario ya existe
        $verificarQuery = "SELECT * FROM personas  WHERE Ci = '$ci'";
        $verificarResult = $this->conexion->conexion->query($verificarQuery);

        if ($verificarResult->num_rows > 0) {
      // El usuario ya existe
        	$response = array('status' => true,'auth' => true,'msg' => 'El usuario ya existe  Doc: '.$ci.', Nomb:'.$nombres.', Apell:'.$apellidos,'data'=> 100);
              echo json_encode($response);
          return;
        } else{
          $sql = "INSERT INTO personas (Nombre, Apellidos, Ci, Telefono, Correo, Sexo, Direccion, Estado, fechaRegisto, estadoinicio, FechaInicio, diasvacacionales, estadovacaciones)
          VALUES ('$nombres','$apellidos','$ci','$telefono','$correo','$sexo','$direccion','Activo', NOW(), 'On', CURRENT_DATE(), '15', 'Trabajo')";

          if ($consulta = $this->conexion->conexion->query($sql)) { 

          	$response = array('status' => true,'auth' => true,'msg' => 'El registro se realizó con éxito.','data'=> 1);
              return json_encode($response);
           
          }else{
             	$response = array('status' => true,'auth' => true,'msg' => 'Ocurrio un error al registrar.','data'=> 0);
              return json_encode($response);
          }
        }
}

function listar_Personas(){
$sql=  "SELECT idpersona, Nombre,Apellidos,Ci,Correo,Sexo,Estado,estadoinicio,FechaInicio, diasvacacionales, Telefono from personas";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                $arreglo["data"][]=$consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
}

function Show_Persona($idususario){

	$sql=  "SELECT idpersona, Nombre, Apellidos, Ci, Telefono, Correo, Sexo, Direccion from personas where idpersona='$idususario' ";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                $arreglo[]=$consulta_VU;

            }
            return $arreglo;
            $this->conexion->cerrar();
        }
}

function Registrar_PersonaSinNada($idPersona,$nombres,$apellidos,$correo,$ci,$telefono,$direccion,$sexo){

   $sql = "UPDATE personas SET Nombre='$nombres', Apellidos='$apellidos', Ci='$ci', Telefono='$telefono', Correo='$correo', Sexo='$sexo', Direccion='$direccion' WHERE idpersona = '$idPersona'";
  if ($consulta = $this->conexion->conexion->query($sql)) {
       $response = array('status' => true,'auth' => true,'msg' => 'La operacion se completo correctamente.','data'=> 1);
      return json_encode($response);
   
    
  }else{
      $response = array('status' => true,'auth' => true,'msg' => 'Ocurrio un error.','data'=> 0);
      return json_encode($response);
  }
}

}
?>