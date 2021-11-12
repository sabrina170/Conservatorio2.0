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
        $id_zoom = $_POST['id_zoom'];
        $psw_zoom = $_POST['psw_zoom'];


        $insertar = $cn->query("INSERT INTO `eventos` (`id`, `id_profe`, `id_alumno`, `curso`, 
                    `color`, `textColor`, `fecha_start`, `fecha_end`, `link`,`id_zoom`,`psw_zoom`,`fecha`)
                     VALUES (NULL,'$id_profe','$id_alum','$curso','$color','$textColor','$fecha_start',
                     '$fecha_end','$link','$id_zoom','$psw_zoom','$fecha')");

        if ($insertar) {
            echo 1;
            // echo 1;
        } else {
            // header('Location:admin.php?nt=4');
            echo mysqli_error($cn);
        }
        break;
    case  'InsertarEventoRecurrente':

        include('controlador/conexion.php');
        $id_profe = $_POST['id_profe'];
        $id_alum = $_POST['id_alum'];
        $curso = $_POST['curso'];
        $color = $_POST['color'];
        $textColor = $_POST['textColor'];
        $fecha_start = $_POST['fecha_ini'];
        $fecha_end = $_POST['fecha_fin'];
        $link = $_POST['link'];
        $hora_ini = $_POST['hora_ini'];
        $hora_fin = $_POST['hora_fin'];
        $dias = $_POST['dias'];

        $insertar = $cn->query("INSERT 
        INTO `eventos_re` (`id`, `id_profe`, `id_alumno`, `curso`, 
                        `color`, `textColor`, `fecha_start`, `fecha_end`, `dias`,
                        `hora_ini`,`hora_fin`,`link`)
                         VALUES (NULL,'$id_profe','$id_alum','$curso',
                         '$color','$textColor','$fecha_start', '$fecha_end','$dias',
                         '$hora_ini','$hora_fin','$link')");

        if ($insertar) {
            echo 1;
            // echo 1;
        } else {
            // header('Location:admin.php?nt=4');
            echo mysqli_error($cn);
        }
        break;


    case  'EliminarEvento':

        include('controlador/conexion.php');
        $id = $_POST['id_even'];
        $tipo_even = $_POST['tipo_even'];
        if ($tipo_even == 1) {
            $insertar = $cn->query("DELETE FROM `eventos` WHERE `eventos`.`id` = '$id'");
            if ($insertar) {
                echo 1;
                // echo 1;
            } else {
                // header('Location:admin.php?nt=4');
                echo mysqli_error($cn);
            }
        } else if ($tipo_even == 2) {
            $insertar = $cn->query("DELETE FROM `eventos_re` WHERE `eventos_re`.`id` = '$id'");
            if ($insertar) {
                echo 1;
                // echo 1;
            } else {
                // header('Location:admin.php?nt=4');
                echo mysqli_error($cn);
            }
        }


        break;

    case  'ActualizarEvento':

        include('controlador/conexion.php');

        $hora_ini = $_POST['hora_ini'];
        $hora_fin = $_POST['hora_fin'];
        $id = $_POST['id_even'];
        $fecha = $_POST['fecha'];
        $tipo_even = $_POST['tipo_even'];
        $dias = $_POST['dias'];
        $fecha_ini = $_POST['fecha_ini'];
        $fecha_fin = $_POST['fecha_fin'];


        if ($tipo_even == 1) {
            $insertar = $cn->query("UPDATE `eventos` SET `fecha_start` = '$hora_ini',
            `fecha_end` = '$hora_fin',`fecha` = '$fecha' WHERE `eventos`.`id` = '$id';");
        } else if ($tipo_even == 2) {
            $insertar = $cn->query("UPDATE `eventos_re` SET `fecha_start` = '$fecha_ini',
            `fecha_end` = '$fecha_fin',`hora_ini` = '$hora_ini',`hora_fin` = '$hora_fin',`dias` = '$dias' WHERE `eventos_re`.`id` = '$id';");
        }


        if ($insertar) {
            echo 1;
            // echo 1;
        } else {
            // header('Location:admin.php?nt=4');
            echo mysqli_error($cn);
        }
        break;
}
