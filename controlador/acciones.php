<?php
session_start();
$accion = $_REQUEST['accion'];

switch ($accion) {
    case  'InsertaUsuario':

        include('conexion.php');
        $revisar = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($revisar) {
            $ruta = 'imagenes/' . $_FILES['foto']['name'];
            // $image = $_FILES['foto']['tmp_name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);

            // genera el color
            $color = '#' . str_pad(dechex(Rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
            // echo ('#' . $Rand);


            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $especialidad = $_POST['especialidad'];
            $tipo = $_POST['tipo'];
            $dni = $_POST['dni'];
            $estado = $_POST['estado'];
            $telefono = $_POST['telefono'];
            // $foto = $_FILES['foto']['tmp_name'];

            $imgContenido = addslashes(file_get_contents($foto));
            $insertar = $cn->query("INSERT INTO `adminuser` (`id`, `nombres`, `apellidos`, `usuario`, 
                `clave`, `especialidad`, `foto`, `tipo`, `estado`, `modificado`, `dni`,`telefono`,`color`)
                 VALUES (NULL,'$nombres','$apellidos','$usuario','$clave','$especialidad','$ruta',
                 '$tipo','$estado','','$dni','$telefono','$color')");

            if ($insertar) {
                header('Location: ../profesores.php?nt=1');
                // echo 1;
            } else {
                // header('Location:admin.php?nt=4');
                echo mysqli_error($cn);
            }
        } else {
            header('Location:../estudiantes.php?nt=6');
        }
        break;

    case  'InsertaUsuario2':

        include('conexion.php');
        $revisar = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($revisar) {
            $ruta = 'imagenes/' . $_FILES['foto']['name'];
            // $image = $_FILES['foto']['tmp_name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);

            // genera el color
            $color = '#' . str_pad(dechex(Rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
            // echo ('#' . $Rand);
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $especialidad = $_POST['especialidad'];
            $tipo = $_POST['tipo'];
            $dni = $_POST['dni'];
            $estado = $_POST['estado'];
            $telefono = $_POST['telefono'];
            // $foto = $_FILES['foto']['tmp_name'];

            $imgContenido = addslashes(file_get_contents($foto));
            $insertar = $cn->query("INSERT INTO `adminuser` (`id`, `nombres`, `apellidos`, `usuario`, 
                `clave`, `especialidad`, `foto`, `tipo`, `estado`, `modificado`, `dni`,`telefono`,`color`)
                 VALUES (NULL,'$nombres','$apellidos','$usuario','$clave','$especialidad','$ruta',
                 '$tipo','$estado','','$dni','$telefono','$color')");

            if ($insertar) {
                header('Location: ../profesores.php?nt=1');
                // echo 1;
            } else {
                // header('Location:admin.php?nt=4');
                echo mysqli_error($cn);
            }
        } else {
            header('Location:../estudiantes.php?nt=6');
        }

        break;

    case  'InsertaAlumno':

        include('conexion.php');
        $revisar = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($revisar) {
            // genera el color
            $color = '#' . str_pad(dechex(Rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
            // echo ('#' . $Rand);
            $ruta = 'imagenes/' . $_FILES['foto']['name'];
            // $image = $_FILES['foto']['tmp_name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);

            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            // $especialidad = $_POST['especialidad'];
            $tipo = $_POST['tipo'];
            $dni = $_POST['dni'];
            $estado = $_POST['estado'];
            $telefono = $_POST['telefono'];
            // $foto = $_FILES['foto']['tmp_name'];

            $insertar = $cn->query("INSERT INTO `adminuser` (`id`, `nombres`, `apellidos`, `usuario`, 
                    `clave`, `especialidad`, `foto`, `tipo`, `estado`, `modificado`, `dni`,`telefono`,`color`)
                     VALUES (NULL,'$nombres','$apellidos','$usuario','$clave','','$ruta',
                     '$tipo','$estado','','$dni','$telefono','$color')");

            if ($insertar) {
                header('Location: ../estudiantes.php?nt=1');
            } else {
                // header('Location:admin.php?nt=4');
                echo mysqli_error($cn);
            }
        } else {
            header('Location:../estudiantes.php?nt=6');
        }

        break;

    case  'EliminarUsuario':
        include('conexion.php');

        $id = $_POST['id'];

        $insertar = $cn->query("DELETE FROM `adminuser` WHERE `adminuser`.`id` = '$id'");
        if ($insertar) {
            header('Location:../admin.php?nt=2');
        } else {
            echo mysqli_error($cn);
        }
        break;
    case  'EliminarUsuario2':
        include('conexion.php');

        $id = $_POST['id'];

        $insertar = $cn->query("DELETE FROM `adminuser` WHERE `adminuser`.`id` = '$id'");
        if ($insertar) {
            header('Location:../profesores.php?nt=2');
        } else {
            echo mysqli_error($cn);
        }
        break;
    case  'EliminarAlumno':
        include('conexion.php');

        $id = $_POST['id'];

        $insertar = $cn->query("DELETE FROM `adminuser` WHERE `adminuser`.`id` = '$id'");
        if ($insertar) {
            header('Location:../estudiantes.php?nt=2');
        } else {
            echo mysqli_error($cn);
        }
        break;
    case  'ActualizarUsuario':

        include('conexion.php');
        $image = $_FILES['foto']['tmp_name'];
        $ruta = 'imagenes/' . $_FILES['foto']['name'];
        // $image = $_FILES['foto']['tmp_name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);

        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $especialidad = $_POST['especialidad'];
        $tipo = $_POST['tipo'];
        $dni = $_POST['dni'];
        $estado = $_POST['estado'];
        // $foto = $_FILES['foto']['tmp_name'];
        $id = $_POST['id'];
        $muser = $_POST['muser'];

        if ($image == '') {
            $insertar = $cn->query("UPDATE `adminuser` SET `nombres` = '$nombres', `apellidos` = '$apellidos', 
            `usuario` = '$usuario', `clave` = '$clave', `especialidad` = '$especialidad', `tipo` = '$tipo',  `dni` = '$dni', `estado` = '$estado' WHERE `adminuser`.`id` = '$id';");

            if ($insertar) {
                $modificado = $cn->query("UPDATE `adminuser` SET `modificado` = '$muser' WHERE `adminuser`.`id` = '$id';");
                if ($modificado) {
                    header('Location: ../Edit-user.php?id=' . $id . '&nt=3');
                } else {
                    header('Location: ../Edit-user.php?id=' . $id . '&nt=3');
                }
                // echo 1;
            } else {
                // header('Location:admin.php?nt=4');
                echo mysqli_error($cn);
            }
        } else {
            $insertar = $cn->query("UPDATE `adminuser` SET `foto` = '$ruta',`nombres` = '$nombres', `apellidos` = '$apellidos', 
                    `usuario` = '$usuario', `clave` = '$clave', `especialidad` = '$especialidad', `tipo` = '$tipo',  `dni` = '$dni', `estado` = '$estado' WHERE `adminuser`.`id` = '$id';");

            if ($insertar) {
                $modificado = $cn->query("UPDATE `adminuser` SET `modificado` = '$muser' WHERE `adminuser`.`id` = '$id';");
                if ($modificado) {
                    header('Location: ../Edit-user.php?id=' . $id . '&nt=3');
                } else {
                    header('Location: ../Edit-user.php?id=' . $id . '&nt=3');
                }
            } else {
                // header('Location:admin.php?nt=4');
                echo mysqli_error($cn);
            }
        }

        break;

    case  'ActualizarUsuario2':

        include('conexion.php');
        $image = $_FILES['foto']['tmp_name'];
        $ruta = 'imagenes/' . $_FILES['foto']['name'];
        // $image = $_FILES['foto']['tmp_name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);

        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $especialidad = $_POST['especialidad'];
        $tipo = $_POST['tipo'];
        $dni = $_POST['dni'];
        $estado = $_POST['estado'];
        // $foto = $_FILES['foto']['tmp_name'];
        $id = $_POST['id'];
        $muser = $_POST['muser'];

        if ($image == '') {
            $insertar = $cn->query("UPDATE `adminuser` SET `nombres` = '$nombres', `apellidos` = '$apellidos', 
            `usuario` = '$usuario', `clave` = '$clave', `especialidad` = '$especialidad', `tipo` = '$tipo',  `dni` = '$dni', `estado` = '$estado' WHERE `adminuser`.`id` = '$id';");

            if ($insertar) {
                $modificado = $cn->query("UPDATE `adminuser` SET `modificado` = '$muser' WHERE `adminuser`.`id` = '$id';");
                if ($modificado) {
                    header('Location: ../Edit-user.php?id=' . $id . '&nt=3');
                } else {
                    header('Location: ../Edit-user.php?id=' . $id . '&nt=3');
                }
                // echo 1;
            } else {
                // header('Location:admin.php?nt=4');
                echo mysqli_error($cn);
            }
        } else {
            $insertar = $cn->query("UPDATE `adminuser` SET `foto` = '$ruta',`nombres` = '$nombres', `apellidos` = '$apellidos', 
                    `usuario` = '$usuario', `clave` = '$clave', `especialidad` = '$especialidad', `tipo` = '$tipo',  `dni` = '$dni', `estado` = '$estado' WHERE `adminuser`.`id` = '$id';");

            if ($insertar) {
                $modificado = $cn->query("UPDATE `adminuser` SET `modificado` = '$muser' WHERE `adminuser`.`id` = '$id';");
                if ($modificado) {
                    header('Location: ../Edit-user.php?id=' . $id . '&nt=3');
                } else {
                    header('Location: ../Edit-user.php?id=' . $id . '&nt=3');
                }
            } else {
                // header('Location:admin.php?nt=4');
                echo mysqli_error($cn);
            }
        }

        break;
    case  'ActualizarAlumno':

        include('conexion.php');
        $image = $_FILES['foto']['tmp_name'];
        $ruta = 'imagenes/' . $_FILES['foto']['name'];
        // $image = $_FILES['foto']['tmp_name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);

        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        // $especialidad = $_POST['especialidad'];
        $tipo = $_POST['tipo'];
        $dni = $_POST['dni'];
        $estado = $_POST['estado'];
        // $foto = $_FILES['foto']['tmp_name'];
        $id = $_POST['id'];
        $muser = $_POST['muser'];

        if ($image == '') {
            $insertar = $cn->query("UPDATE `adminuser` SET `nombres` = '$nombres', `apellidos` = '$apellidos', 
                `usuario` = '$usuario', `clave` = '$clave',  `tipo` = '$tipo',  `dni` = '$dni', `estado` = '$estado' WHERE `adminuser`.`id` = '$id';");

            if ($insertar) {
                $modificado = $cn->query("UPDATE `adminuser` SET `modificado` = '$muser' WHERE `adminuser`.`id` = '$id';");
                if ($modificado) {
                    header('Location: ../Edit-alum.php?id=' . $id . '&nt=3');
                } else {
                    header('Location: ../Edit-alum.php?id=' . $id . '&nt=3');
                }
                // echo 1;
            } else {
                // header('Location:admin.php?nt=4');
                echo mysqli_error($cn);
            }
        } else {
            $insertar = $cn->query("UPDATE `adminuser` SET `foto` = '$ruta',`nombres` = '$nombres', `apellidos` = '$apellidos', 
                        `usuario` = '$usuario', `clave` = '$clave', `especialidad` = '$especialidad', `tipo` = '$tipo',  `dni` = '$dni', `estado` = '$estado' WHERE `adminuser`.`id` = '$id';");

            if ($insertar) {
                $modificado = $cn->query("UPDATE `adminuser` SET `modificado` = '$muser' WHERE `adminuser`.`id` = '$id';");
                if ($modificado) {
                    header('Location: ../Edit-alum.php?id=' . $id . '&nt=3');
                } else {
                    header('Location: ../Edit-alum.php?id=' . $id . '&nt=3');
                }
            } else {
                // header('Location:admin.php?nt=4');
                echo mysqli_error($cn);
            }
        }
        break;

    case  'RegistrarCurso':

        require_once('conexion.php');

        // $muser = $_POST['muser'];
        $categoria = $_POST['categoria'];
        $tipo = $_POST['tipo'];
        $cantidad = $_POST['cantidad'];
        $tiempo = $_POST['tiempo'];
        $fecha = $_POST['fecha'];
        $id_pro = $_POST['id_pro'];
        $id_mes = $_POST['id_mes'];
        $modo = $_POST['modo'];


        $respuesta = $cn->query("INSERT INTO `curso` (`id_curso`, `categoria`, 
            `tipo`,  `cantidad`, `tiempo`, `fecha`,`id_pro`, `id_mes`,`modo`) 
             VALUES (NULL, '$categoria', '$tipo', '$cantidad', '$tiempo', 
             '$fecha',  '$id_pro', '$id_mes','$modo');");

        if ($respuesta) {
            header('location:../cursos.php?id_pro=' . $id_pro . '&id_mes=' . $id_mes . '&nt=1');
        } else {
            echo $cn->error;
        }

        break;
    case  'ActualizarCurso':

        require_once('conexion.php');
        $categoria = $_POST['categoria'];
        $tipo = $_POST['tipo'];
        $cantidad = $_POST['cantidad'];
        $tiempo = $_POST['tiempo'];
        $fecha = $_POST['fecha'];
        $id_pro = $_POST['id_pro'];
        $id_mes = $_POST['id_mes'];
        $id_cur = $_POST['id_cur'];
        $muser = $_POST['muser'];
        $modo = $_POST['modo'];

        $respuesta = $cn->query("UPDATE `curso` SET `tiempo` = '$tiempo' , `categoria` = '$categoria' ,`tipo` = '$tipo' 
         ,`fecha` = '$fecha' ,`cantidad` = '$cantidad',`modo` = '$modo'  WHERE `curso`.`id_curso` = '$id_cur';");

        if ($respuesta) {
            $respuesta2 = $cn->query("UPDATE `curso` SET `modificado` = 'Actualizado por $muser'  
             WHERE `curso`.`id_curso` = '$id_cur';");

            if ($respuesta2) {
                header('location:../Edit-curso.php?id_cur=' . $id_cur . '&id_pro=' . $id_pro . '&id_mes=' . $id_mes . '&nt=3');
            } else {
                echo $cn->error;
            }
        } else {
            // http://localhost/conmusica/Edit-curso.php?id_cur=1073&id=15&id_mes=7&nt=0
            echo $cn->error;
        }

        break;
    case  'EliminarCurso':
        include('conexion.php');

        $id_cur = $_POST['id_cur'];
        $id_pro = $_POST['id_pro'];
        $id_mes = $_POST['id_mes'];

        $insertar = $cn->query("DELETE FROM `curso` WHERE `curso`.`id_curso` = '$id_cur'");
        if ($insertar) {
            // cursos.php?id_pro=15&id_mes=7&nt=0
            header('Location: ../cursos.php?id_pro=' . $id_pro . '&id_mes=' . $id_mes . '&nt=2');
        } else {
            echo mysqli_error($cn);
        }
        break;
}
