<?php include('header-link.php');
if (!isset($_SESSION['user_tipo'])) {
    header('Location:index.php?nt=0');
} else {
}
?>

<?php include('header.php');
include('controlador/conexion.php');
$id_pro = $_SESSION['user_id'];
$consulta = "SELECT * FROM adminuser where id = '$id_pro'";
$resultado = mysqli_query($cn, $consulta);
$registro = $cn->query("SELECT * FROM mes");
?>
<style>
    table,
    td,
    tr,
    th,
    tbody {
        border: 1px solid #06599e !important;
    }
</style>

<div class="content-wrapper" style="padding: 0px 30px 30px 30px; background-color: #e0e0e0;">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="text-center m-0" style="color: #06599e;">Hola, Bienvenida <strong><?php echo $_SESSION['user_nombre'] ?> </strong> </h1>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $posicion = 1;
            foreach ($resultado as $show) {
            ?>
                <div class="card">
                    <div class="card-header">
                        Información Personal
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <!-- <label for="inputState">Foto</label> -->
                                <?php if ($_SESSION['user_foto'] == '') {
                                ?>
                                    <img src="controlador/imagenes/defecto.png" class="img-circle elevation-2" alt="User Image" width="60">
                                <?php
                                } else { ?>
                                    <img src="controlador/<?php echo $_SESSION['user_foto'] ?>" class="img-circle elevation-2" alt="User Image">
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-md-2">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="inputEmail4">Nombres :</label>
                                        <h6 for="inputEmail4"><?php echo $show['nombres'] ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="inputEmail4">Apellidos :</label>
                                        <h6 for="inputEmail4"><?php echo $show['apellidos'] ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="inputEmail4">Dni :</label><br>
                                        <h6 for="inputEmail4"><?php echo $show['dni'] ?></h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="inputEmail4">Celular :</label><br>
                                        <h6 for="inputEmail4"><?php echo $show['telefono'] ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="inputEmail4">Especialidad :</label><br>
                                        <h6 for="inputEmail4"><?php echo $show['especialidad'] ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }
                ?>
                </div>
                <div class="col-md-12">

                    <div class="card-header">
                        Meses
                    </div>
                    <br>
                    <div class="row row-cols-1 row-cols-md-3">
                        <?php
                        $posicion = 1;
                        foreach ($registro as $show) {
                        ?>

                            <div class="col mb-4">
                                <a href="det-cursos.php?id_pro=<?php echo $id_pro; ?>&id_mes=<?php echo $show['id_mes']; ?>" style="color: black;">
                                    <div class="card">

                                        <div class="card-body">
                                            <h5 class="card-title text-center"><strong> <?php echo utf8_encode($show['nombre']) ?></strong></h5>
                                            <br>
                                            <?php
                                            $idm = $show['id_mes'];
                                            $registro2 = $cn->query("SELECT categoria.nombre as categoria, subcategoria.nombre as tipo, sum(cantidad) AS suma, tiempo
                            FROM curso  
                           JOIN categoria ON curso.categoria=categoria.id_cat
                           JOIN subcategoria ON curso.tipo=subcategoria.id_sub where
                                             id_mes = '$idm' and id_pro = '$id_pro' GROUP BY categoria, tipo,tiempo");

                                            if (mysqli_num_rows($registro2) == 0) {
                                            ?>
                                                <span class="text-primary mr-2">Ninguna categoria</span>

                                            <?php
                                            } else {
                                            ?>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered ">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th scope="col">Categoria</th>
                                                                <th scope="col">Tipo</th>
                                                                <th scope="col">Tiempo</th>
                                                                <th scope="col">Total</th>

                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        foreach ($registro2 as $show) {
                                                        ?> <tbody>
                                                                <tr>
                                                                    <td> <span class=" mr-2">
                                                                            <?php if ($show['categoria'] == 'Curso Libre') { ?>
                                                                                <h4> <span class="badge " style="background-color: pink;"><?php echo $show['categoria'] ?></span></h4>
                                                                            <?php } else if ($show['categoria'] == 'Teoría') { ?>
                                                                                <h4> <span class="badge " style="background-color: #f95454;"><?php echo $show['categoria'] ?></span></h4>
                                                                            <?php } else if ($show['categoria'] == 'Practica') { ?>
                                                                                <h4> <span class="badge " style="background-color: yellow;"><?php echo $show['categoria'] ?></span></h4>
                                                                            <?php } else if ($show['categoria'] == 'Diplomado') { ?>
                                                                                <h4> <span class="badge " style="background-color: black; color: white;"><?php echo $show['categoria'] ?></span></h4>
                                                                            <?php } else if ($show['categoria'] == 'Superior') { ?>
                                                                                <h4> <span class="badge " style="background-color: #4e73df;"><?php echo $show['categoria'] ?></span></h4>
                                                                            <?php } else if ($show['categoria'] == 'Fobas') { ?>
                                                                                <h4> <span class="badge " style="background-color: skyblue;"><?php echo $show['categoria'] ?></span></h4>
                                                                            <?php } else if ($show['categoria'] == 'Fobas niño') { ?>
                                                                                <h4> <span class="badge " style="background-color: #2bef45;"><?php echo $show['categoria'] ?></span></h4>
                                                                            <?php } else if ($show['categoria'] == 'Especialidad') { ?>
                                                                                <h4> <span class="badge " style="background-color: purple;color: white;"><?php echo $show['categoria'] ?></span></h4>
                                                                            <?php } ?> </td>
                                                                    <td> <span class=" mr-2"><?php echo $show['tipo']; ?></span> </td>
                                                                    <td> <span class=" mr-2"><?php echo $show['tiempo']; ?> " </span> </td>
                                                                    <td> <span class=" mr-2"><?php echo $show['suma']; ?></span> </td>
                                                                </tr>
                                                            <?php

                                                        }
                                                            ?>
                                                    </table>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>

                </div>
        </div>

    </div>


    <?php include('footer.php'); ?>