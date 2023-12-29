<?php
class Vacaciones
{
    private $conexion;
    function __construct()
    {
        require_once 'modelo_conexion.php';
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }

    function Listar_Personas_Vacaciones()
    {
        $sql = "select idpersona,Nombre,Apellidos,Ci,diasvacacionales, estadovacaciones FROM personas";

        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                $arreglo['data'][] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }
    function Data_Show_Persona($idpersona)
    {

        $sql = "SELECT idpersona,Nombre,Apellidos,Ci,diasvacacionales FROM personas where idpersona='$idpersona' ";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    function Registrar_Vacaciones_Empleado($idempleado, $diadisponibleactual, $fechainicio, $fechafinal, $descrition, $diasselecionados)
    {
        $sql = "INSERT INTO vacaciones(idempleado, fechinicio, fechafinal, diasvacaciones, descripcion,datecreate) 
    VALUES ('$idempleado','$fechainicio','$fechafinal','$diasselecionados','$descrition',NOW())";
        if ($consulta = $this->conexion->conexion->query($sql)) {

            $this->Actualizar_Estado_Persona($idempleado, $diadisponibleactual);

            $response = array('status' => true, 'auth' => true, 'msg' => 'La operación se completo corectamente.', 'data' => 1);
            return json_encode($response);
        } else {
            $response = array('status' => true, 'auth' => true, 'msg' => 'No se pudo completar el regitro', 'data' => 0);
            return json_encode($response);
        }
    }

    function Actualizar_Estado_Persona($idempleado, $diadisponibleactual)
    {

        $sql = "UPDATE personas SET diasvacacionales='$diadisponibleactual', estadovacaciones='Vacaciones' WHERE idpersona= '$idempleado' ";
        if ($consulta = $this->conexion->conexion->query($sql)) {
            return 1;
        } else {
            return 0;
        }
    }


    function Personal_Vacaciones_backgroundRunn()
    {
        $sql = "SELECT idempleado, fechinicio, fechafinal FROM vacaciones";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    function Listar_Empleados_Cambiar_Estado($elemt, $estado)
    {

        $sql = "UPDATE personas SET  estadovacaciones='$estado' WHERE idpersona= '$elemt' ";
        if ($consulta = $this->conexion->conexion->query($sql)) {
            return 1;
        } else {
            return 0;
        }
    }

    function Listar_Vacaciones()
    {
        $sql = "select idpersona,Nombre, Apellidos,Ci, fechinicio, fechafinal, diasvacaciones, FechaInicio, diasvacacionales FROM vacaciones inner join personas on personas.idpersona = vacaciones.idempleado;";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                $arreglo['data'][] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    function Listar_Vacaciones_filters($fechainicio, $fechafin)
    {
        $sql = "select  idpersona,Nombre, Apellidos, Ci, fechinicio, fechafinal,FechaInicio, diasvacaciones FROM vacaciones
        inner join  personas on personas.idpersona = vacaciones.idempleado
        WHERE  (vacaciones.datecreate BETWEEN '$fechainicio' AND '$fechafin')";

        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {
            while ($consulta_VU = mysqli_fetch_assoc($consulta)) {

                $arreglo['data'][] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }
}
?>