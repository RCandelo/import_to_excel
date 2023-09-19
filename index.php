<!DOCTYPE html>
<html lang="es">
<head>
    <?php include("head.php"); ?>
</head>
<body>
<div class="container">
    <h2>Cargar e importar archivo excel a MySQL</h2>
    <form name="importa" method="post" action="./logic/import_excel.php" enctype="multipart/form-data">
        <div class="col-xs-4">
            <div class="form-group">
                <input type="file" class="filestyle" data-buttonText="Seleccione archivo" name="datosEmpleados">
                <label class="file-input__label" for="file-input">
                    <span>Elegir Archivo Excel</span></label>
            </div>
        </div>
        <div class="col-xs-2">
            <p>boton</p>
            <input type="submit" name="subir" value="subir excel">
        </div>
    </form>

    <?php
    header("Content-Type: text/html;charset=utf-8");
    include('./sql/consulta.php');
    $obj_empleados = new consulta();
    $total_client = $obj_empleados->listar_empleados();
    ?>

    <h6 class="text-center">
       Lista de Clientes <strong>(<?php //echo $total_client; ?>)</strong>
    </h6>
    <?php
    $obj_agenda = new consulta();
        $actividades = $obj_agenda->listar_empleados();
    if(isset($actividades)){
        $nfilas = count($actividades);

        if($nfilas > 0) {
            print("<table>\n");
            print("<tr>\n");
            print("<th>&nbsp Nombre</th>\n");
            print("<th>&nbsp Cedula</th>\n");
            print("<th>&nbsp Ubicacion</th>\n");
            print("<th>&nbsp email &nbsp</th>\n");
            print("</tr>\n");

            foreach($actividades as $actividad) {
                print("<tr>\n");
                print("<tr>\n<td> &nbsp".$actividad['nombre_empleado']."&nbsp</td>\n");
                print("<td> &nbsp" . $actividad['cedula_empleado'] . "&nbsp</td>\n");
                print("<td> &nbsp" . $actividad['ubicacion'] . "&nbsp</td>\n");
                print("<td> &nbsp" . $actividad['email'] . "&nbsp</td>\n");
                //$datetimerange = new DateTime($actividad['rango']);
                //print("<td>&nbsp" . $datetimerange->format("d/M/Y") . "&nbsp</td>\n");
                print("&nbsp</td>\n");
                print("</tr>\n");
            }
            print("</table>\n");

        } else {
            print("No tiene actividades registradas.");
        }
    }else { print("No hay registro");
    }

    ?>

</div>

<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>


<?php include("foot.php"); ?>
</body>
</html>
