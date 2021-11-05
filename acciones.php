<?php

require_once('controlador/conexion.php');

$accion = $_REQUEST['accion'];

switch ($accion) {

    case 'BuscarColegio':
        require_once('controlador/conexion.php');

        $idcategoria = $_POST['idcategoria'];
        $subcategorias = $cn->query("SELECT * FROM subcategoria WHERE id_cat = '$idcategoria'");
        // $resultado_sub = mysqli_query($cn, $subcategorias);

        // echo '<option value ="">Selecciona un tipo  </option>';

        if (mysqli_num_rows($subcategorias) == 0) {
            echo '<option value = "-">-</option>';
        } else {

            while ($data = mysqli_fetch_assoc($subcategorias)) {
                echo '<option value = "' . $data['id_sub'] . '">' . $data['nombre'] . '</option>';
            }
        }

        break;
    case  'InsertarEvento':

        include('controlador/conexion.php');
        $id_profe = $_POST['id_profe'];
        $id_alum = $_POST['id_alum'];
        $curso = $_POST['curso'];
        $color = $_POST['color'];
        $textColor = $_POST['textColor'];
        $fecha_start = $_POST['fecha_start'];
        $fecha_end = $_POST['fecha_end'];
        $link = $_POST['link'];
        $fecha = $_POST['fecha'];

        $insertar = $cn->query("INSERT INTO `eventos` (`id`, `id_profe`, `id_alumno`, `curso`, 
                    `color`, `textColor`, `fecha_start`, `fecha_end`, `link`,`fecha`)
                     VALUES (NULL,'$id_profe','$id_alum','$curso','$color','$textColor','$fecha_start',
                     '$fecha_end','$link','$fecha')");

        if ($insertar) {
            echo 1;
            // echo 1;
        } else {
            // header('Location:admin.php?nt=4');
            echo mysqli_error($cn);
        }
        break;

    case  'EliminarEvento':

        include('conexion.php');
        echo 'vista eliminar';
        break;

    case  'ActualizarEvento':


        break;
}
