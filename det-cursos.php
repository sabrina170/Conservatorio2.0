<?php include('header-link.php');
if (!isset($_SESSION['user_tipo'])) {
    header('Location:index.php?nt=0');
} else {
} ?>

<?php include('header.php');
$id_pro = $_REQUEST['id_pro'];
$id_mes = $_REQUEST['id_mes'];

$mes = $cn->query("SELECT * FROM mes WHERE id_mes='$id_mes'")->fetch_assoc();

$registro = $cn->query("SELECT id_curso, modificado ,id_pro, categoria.nombre as categoria, subcategoria.nombre as tipo, cantidad,tiempo,fecha , id_pro,id_mes
FROM curso  
JOIN categoria ON curso.categoria=categoria.id_cat
JOIN subcategoria ON curso.tipo=subcategoria.id_sub
where id_pro = '$id_pro' and id_mes = '$id_mes' ");

$consulta_categoria = $cn->query("SELECT * FROM categoria");
?>

<div class="content-wrapper" style="padding: 0px 30px 30px 30px; background-color: #e0e0e0;">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <a href="mis-cursos.php" style="color: #06599e;"><strong> <i class="fas fa-arrow-alt-circle-left"></i> VOLVER</strong> </a>
                </div>
                <div class="col-sm-8">
                    <h1 class="m-0" style="color: #06599e;">Mis Cursos del mes de <strong><?php echo $mes['nombre']; ?></strong></h1>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding: 10px;">

                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table" id="usuarios">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nr0</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Tiempo</th>
                                <?php if ($_SESSION['user_tipo'] == 1) {
                                ?>
                                    <th scope="col">Modificado</th>
                                <?php
                                }
                                ?>

                                <th scope="col">Fecha de creación</th>
                                <?php if ($_SESSION['user_tipo'] == 1 || $_SESSION['user_tipo'] == 3) {
                                ?>
                                    <th scope="col">Acciones</th>
                                <?php
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $posicion = 1;
                            foreach ($registro as $show) {
                            ?>
                                <tr>
                                    <th>
                                        <?php echo $posicion;
                                        $posicion++ ?>
                                    </th>
                                    <td>
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
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php echo $show['tipo'] ?>
                                    </td>
                                    <td>
                                        <?php echo $show['cantidad'] ?>
                                    </td>
                                    <td>
                                        <?php echo $show['tiempo'] ?>
                                    </td>
                                    <?php if ($_SESSION['user_tipo'] == 1) {

                                    ?>
                                        <td>
                                            <?php echo $show['modificado'] ?>
                                        </td>
                                    <?php
                                    }
                                    ?>

                                    <td>
                                        <?php echo $show['fecha'] ?>
                                    </td>
                                    <?php if ($_SESSION['user_tipo'] == 1 || $_SESSION['user_tipo'] == 3) {
                                    ?>
                                        <td>
                                            <a href="Edit-curso.php?id_cur=<?php echo $show['id_curso'] ?>&id_pro=<?php echo $show['id_pro'] ?>&id_mes=<?php echo $show['id_mes'] ?>&nt=0"> <i class="fas fa-edit"></i></a>
                                            <a href="" data-toggle="modal" data-target="#Eliminar<?php echo $show['id_curso'] ?>"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    <?php
                                    }
                                    ?>
                                </tr>

                            <?php
                                include('modals/modal-EliminarCurso.php');
                            } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<?php include('footer.php'); ?>
<script>
    $(document).ready(function() {

        $('#usuarios').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },

        });
    });
</script>