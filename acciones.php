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
}
