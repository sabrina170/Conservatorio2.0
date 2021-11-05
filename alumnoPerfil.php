<?php include('header-link.php');
if (!isset($_SESSION['user_tipo'])) {
    header('Location:index.php?nt=0');
} else {
    if ($_SESSION['user_tipo'] == 2) {
        header('Location:index.php?nt=0');
    } else if ($_SESSION['user_tipo'] == 3) {
        header('Location:index.php?nt=0');
    }
}
?>

<?php include('header.php');
include('controlador/conexion.php');
$id_pro = $_SESSION['user_id'];
$consulta = "SELECT * FROM adminuser where id = '$id_pro'";
$resultado = mysqli_query($cn, $consulta);
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
                                    <img src="controlador/imagenes/defecto.png" class="img-circle elevation-2" alt="User Image" width="100">
                                <?php
                                } else { ?>
                                    <img src="controlador/<?php echo $_SESSION['user_foto'] ?>" class="img-circle elevation-2" alt="User Image" width="60">
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
        </div>

    </div>

</div>
<script>
</script>
<?php include('footer.php'); ?>