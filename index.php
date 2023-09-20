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
    $total_colaboradores= $obj_empleados->listar_empleados();
    ?>

    <h6 class="text-center">
       Lista de Colaboradores <strong>(<?php echo $total_colaboradores; ?>)</strong>
    </h6>
    <?php
    $obj_agenda = new consulta();
        $registros = $obj_agenda->listar_empleados();
    if(isset($registros)){
        $nfilas = count($registros);

        if($nfilas > 0) {
            print("<table>\n");
            print("<tr>\n");
            print("<th>&nbsp Nombre</th>\n");
            print("<th>&nbsp Cedula</th>\n");
            print("<th>&nbsp Ubicacion</th>\n");
            print("<th>&nbsp email &nbsp</th>\n");
            print("</tr>\n");

            foreach($registros as $registro) {
                print("<tr>\n");
                print("<tr>\n<td> &nbsp".$registro['nombre_empleado']."&nbsp</td>\n");
                print("<td> &nbsp" . $registro['cedula_empleado'] . "&nbsp</td>\n");
                print("<td> &nbsp" . $registro['ubicacion'] . "&nbsp</td>\n");
                print("<td> &nbsp" . $registro['email'] . "&nbsp</td>\n");
                //$datetimerange = new DateTime($registro['rango']);
                //print("<td>&nbsp" . $datetimerange->format("d/M/Y") . "&nbsp</td>\n");
                print("&nbsp</td>\n");
                print("</tr>\n");
            }
            print("</table>\n");

        } else {
            print("No tiene registros registradas.");
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
