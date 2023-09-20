<?php
include('../sql/consulta.php');
$obj_empleados = new consulta();
$cant_duplicidad = 0;

$archivotmp = $_FILES['datosEmpleados']['tmp_name'];
$lineas = file($archivotmp);

$encabezados = str_getcsv(array_shift($lineas), ';');

$datosProcesados = [];

foreach ($lineas as $linea) {
    $datos = str_getcsv($linea, ';');
    $registro = array_combine($encabezados, $datos);
    $datosProcesados[] = $registro;
}

foreach ($datosProcesados as $registro) {
    $estado = $registro['Estado'];
    $nombre = $registro['Nombre'];
    $codigo = $registro['Codigo'];
    $identificacion = $registro['Identificacion'];
    $email = $registro['EMail'];
    $departamento = $registro['Departamento'];
    $centro_costo = $registro['Centro de Costo'];
    $sexo = $registro['Sexo'];
    $fecha_nacimiento = $registro['Fecha Nacimiento'];
    $fecha_ingreso = $registro['Fecha Ingreso'];
    $ubicacion = $registro['Ubicacion'];

    // Validar duplicidad de cédula
    if (!empty($identificacion)) {
        $obj_empleados->setCedula($identificacion);
        $result_cedula_duplicidad = $obj_empleados->validar_cedula();
    }

    if ($cant_duplicidad == 0) {
        // Insertar el registro si no existe duplicidad de cédula
        $obj_empleados->setId(isset($codigo) ? $codigo : null);
        $obj_empleados->setEstado(isset($estado) ? $estado : null);
        $obj_empleados->setNombre($nombre);
        $obj_empleados->setCedula($identificacion);
        $obj_empleados->setEmail($email);
        $obj_empleados->setC_Departamento($departamento);
        $obj_empleados->setC_Centro_Costo($centro_costo);
        $obj_empleados->setSexo($sexo);
        $obj_empleados->setFecha_Nacimiento($fecha_nacimiento);
        $obj_empleados->setFecha_Ingreso($fecha_ingreso);
        $obj_empleados->setUbicacion($ubicacion);

        $obj_empleados->insertar_empleados();
    } else {
        echo "<p>Esta cédula ya existe: $identificacion</p>";
    }
}

?>

<a href="index.php">Atrás</a>
