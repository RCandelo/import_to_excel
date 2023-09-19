<?php
include('../sql/consulta.php');
$obj_empleados = new consulta();
$cant_duplicidad = 0;

$archivotmp = $_FILES['datosEmpleados']['tmp_name'];
$lineas = file($archivotmp);

foreach ($lineas as $i => $linea) {
    if ($i != 0) {
        $datos = explode(";", $linea);

        $idIndex = array_search('Codigo', $datos, true);
        $nombreIndex = array_search('Nombre', $datos, true);
        $cedulaIndex = array_search('Identificacion', $datos, true);
        $emailIndex = array_search('Email', $datos, true);
        $estadoIndex = array_search('Estado', $datos, true);
        $codigo_departamentoIndex = array_search('Departamento', $datos, true);
        $codigo_centro_costoIndex = array_search('Centro de Costo', $datos, true);
        $sexoIndex = array_search('Sexo', $datos, true);
        $fecha_nacimientoIndex = array_search('Fecha Nacimiento', $datos, true);
        $fecha_ingresoIndex = array_search('Fecha Ingreso', $datos, true);
        $ubicacionIndex = array_search('Ubicacion', $datos, true);

        $nombre = $nombreIndex !== true ? $datos[$nombreIndex] : '';
        $id = $idIndex !== false ? $datos[$idIndex] : '';
        $cedula = $cedulaIndex !== false ? $datos[$cedulaIndex] : '';
        $email = $emailIndex !== true ? $datos[$emailIndex] : '';
        $estado = $estadoIndex !== false ? $datos[$estadoIndex] : '';
        $codigo_departamento = $codigo_departamentoIndex !== false ? $datos[$codigo_departamentoIndex] : '';
        $codigo_centro_costo = $codigo_centro_costoIndex !== false ? $datos[$codigo_centro_costoIndex] : '';
        $sexo = $sexoIndex !== false ? $datos[$sexoIndex] : '';
        $fecha_nacimiento = $fecha_nacimientoIndex !== false ? $datos[$fecha_nacimientoIndex] : '';
        $fecha_ingreso = $fecha_ingresoIndex !== false ? $datos[$fecha_ingresoIndex] : '';
        $ubicacion = $ubicacionIndex !== false ? $datos[$ubicacionIndex] : '';

        $obj_empleados->setId(isset($id) ? $id : null);
        $obj_empleados->setNombre(isset($nombre) ? $nombre : null);
        $obj_empleados->setCedula(isset($cedula) ? $cedula : null);
        $obj_empleados->setEmail(isset($email) ? $email : null);
        $obj_empleados->setEstado(isset($estado) ? $estado : null);
        $obj_empleados->setC_Departamento(isset($codigo_departamento) ? $codigo_departamento : null);
        $obj_empleados->setC_Centro_Costo(isset($codigo_centro_costo) ? $codigo_centro_costo : null);
        $obj_empleados->setSexo(isset($sexo) ? $sexo : null);
        $obj_empleados->setFecha_Nacimiento(isset($fecha_nacimiento) ? $fecha_nacimiento : null);
        $obj_empleados->setFecha_Ingreso(isset($fecha_ingreso) ? $fecha_ingreso : null);
        $obj_empleados->setUbicacion(isset($ubicacion) ? $ubicacion : null);

        if (!empty($cedula)) {
            $checkemail_duplicidad = $obj_empleados->validar_cedula();
            $ca_dupli = mysqli_query($con, $checkemail_duplicidad);
            $cant_duplicidad = mysqli_num_rows($ca_dupli);
        }

        if ($cant_duplicidad == 0) {
            $obj_empleados->insertar_empleados(
                $id,
                $nombre,
                $cedula,
                $email,
                $estado,
                $codigo_departamento,
                $codigo_centro_costo,
                $sexo,
                $fecha_nacimiento,
                $fecha_ingreso,
                $ubicacion
            );
        } else {
            echo "<p>Esta cedula existe</p>";
        }
    }
}
?>

<a href="index.php">Atrás</a>


