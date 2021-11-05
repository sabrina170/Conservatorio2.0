<?php

require_once("controlador/conexion.php");

// strip tags may not be the best method for your project to apply extra layer of security but fits needs for this tutorial 
$search = $_POST['profe'];

// Do Prepared Query
$query = mysqli_query($cn, "SELECT * FROM adminuser WHERE id  = '$search'");
echo mysqli_error($cn);
if ($query) {
    while ($list = mysqli_fetch_assoc($query)) {
        $cupon_estructura = array(
            'nombres' => $list['nombres'],
            'color' => $list['color'],
            'especialidad' => $list['especialidad'],
        );
        echo json_encode($cupon_estructura);
    }
} else {
    echo $cn->error;
}
