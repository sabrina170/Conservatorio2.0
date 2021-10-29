<?php include('header-link.php');
if (!isset($_SESSION['user_tipo'])) {
    header('Location:index.php?nt=0');
} else {
    if ($_SESSION['user_tipo'] == 2) {
        header('Location:index.php?nt=0');
    }
} ?>

<?php include('header.php');
$id_pro = $_REQUEST['id_pro'];
$id_mes = $_REQUEST['id_mes'];
$nt = $_REQUEST['nt'];

$pro = $cn->query("SELECT * FROM adminuser WHERE id='$id_pro'")->fetch_assoc();
$mes = $cn->query("SELECT * FROM mes WHERE id_mes='$id_mes'")->fetch_assoc();

$registro = $cn->query("SELECT id_curso, modificado ,id_pro, categoria.nombre as categoria, subcategoria.nombre as tipo, cantidad,tiempo,fecha , id_pro,id_mes,modo
FROM curso  
JOIN categoria ON curso.categoria=categoria.id_cat
JOIN subcategoria ON curso.tipo=subcategoria.id_sub
where id_pro = '$id_pro' and id_mes = '$id_mes' ");

$consulta_categoria = $cn->query("SELECT * FROM categoria");
?>
<style>
    .dt-button {
        padding: 0;
        border: none;
        margin-bottom: 10px;
    }
</style>
<div class="content-wrapper" style="padding: 0px 30px 30px 30px; background-color: #e0e0e0;">
    <?php
    if ($nt == 1) {
    ?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script>
            Swal.fire(
                'Insertado!',
                'Curso creado correctamente!',
                'success'
            ).then(function() {
                window.location.href = "cursos.php?id_pro=<?php echo $id_pro ?>&id_mes=<?php echo $id_mes; ?>&nt=0";
            });
            // window.location.href = "tutoriales.php ";
        </script>
    <?php
    } else if ($nt == 2) {
    ?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script>
            Swal.fire(
                'Eliminado!',
                'Curso eliminado correctamente!',
                'error'
            ).then(function() {
                window.location.href = "cursos.php?id_pro=<?php echo $id_pro ?>&id_mes=<?php echo $id_mes; ?>&nt=0";
            });
            // window.location.href = "tutoriales.php ";
        </script>
    <?php
    }
    ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <a href="meses.php?id_pro=<?php echo $id_pro; ?>" style="color: #06599e;"><strong> <i class="fas fa-arrow-alt-circle-left"></i> VOLVER</strong> </a>
                </div>
                <div class="col-sm-8">
                    <h1 class="m-0" style="color: #06599e;">Cursos del mes de <strong><?php echo $mes['nombre']; ?></strong> de <strong> <?php echo $pro['nombres'], ' ', $pro['apellidos']; ?></strong> </h1>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Insertar un Curso
                </div>
                <div class="card-body">
                    <form action="controlador/acciones.php?accion=RegistrarCurso" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputState">Categoria</label>
                                <select class="form-control" name="categoria" id="categoria" required>
                                    <option value="" selected>Seleciona una categoria</option>
                                    <?php
                                    foreach ($consulta_categoria as $categoria) {
                                        echo '<option  value="' . $categoria['id_cat'] . '">' . $categoria['nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputState">Tipo</label>
                                <select class="form-control" name="tipo" id="tipo" required>
                                    <option value="" disabled selected>Selecciona un tipo</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Tiempo</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tiempo" value="45" checked>
                                    <label class="form-check-label">45</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tiempo" value="60">
                                    <label class="form-check-label">60</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tiempo" value="90">
                                    <label class="form-check-label">90</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Fecha</label>
                                <input type="date" class="form-control" name="fecha" value="<?php echo date("Y-m-d"); ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputState">Modo</label>
                                <select class="form-control" name="modo" id="modo" required>
                                    <option value="" disabled selected>Selecciona un modo</option>
                                    <option value="1">Virtual</option>
                                    <option value="2">Presencial</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="id_pro" id="id_pro" value="<?php echo $id_pro; ?>">
                        <input type="hidden" class="form-control" name="id_mes" id="id_mes" value="<?php echo $id_mes; ?>">

                        <button type="submit" class="btn btn-primary">Insertar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
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
                                    <th scope="col">Modo</th>

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
                                        <td>
                                            <?php
                                            if ($show['modo'] == 1) {
                                                echo 'Virtual';
                                            } else if ($show['modo'] == 2) {
                                                echo 'Presencial';
                                            }
                                            // echo $show['modo'] 
                                            ?>
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
            "dom": 'Blfrtip',
            buttons: [{
                    //Botón para Excel
                    extend: 'excel',
                    footer: true,
                    title: 'Archivo',
                    filename: 'Excel de Cursos ',

                    //Aquí es donde generas el botón personalizado
                    text: '<button class="btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></button>'
                },
                //Botón para PDF
                {
                    extend: 'pdf',
                    footer: true,
                    title: 'Archivo PDF',
                    filename: 'Pdf de Cursos',
                    text: '<button class="btn btn-danger">Exportar a PDF <i class="far fa-file-pdf"></i></button>'
                },
                {
                    extend: 'print',
                    footer: true,
                    title: 'Imprimir',
                    filename: 'Archivo Cursos',
                    text: '<button class="btn btn-info">Imprimir <i class="fas fa-print"></i></button>'
                }

            ]

        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#categoria').on('change', function() {

            var categoria = $(this).val();

            if ($('#categoria').val() == "") {
                $('#tipo').empty();
                // $('<option value = "">Selecciona un tipo</option>').appendTo('#tipo');
                $('#tipo').attr('disabled', 'disabled');
            } else {
                $('#tipo').removeAttr('disabled', 'disabled');

                $.ajax({
                    type: "POST",
                    url: "acciones.php",
                    data: {
                        accion: "BuscarColegio",
                        idcategoria: categoria
                    },
                    success: function(data) {
                        console.log(data);
                        $('#tipo').html(data);
                    }
                });

                //$('#tipo').load('colegios_get.php?colegio_distrito=' + $('#colegio_distrito').val());
            }
        });

        $('#categoria2').on('change', function() {


            var categoria = $(this).val();

            if ($('#categoria2').val() == "") {
                $('#tipo2').empty();
                // $('<option value = "">Selecciona un tipo</option>').appendTo('#tipo');
                $('#tipo2').attr('disabled', 'disabled');
            } else {
                $('#tipo2').removeAttr('disabled', 'disabled');

                $.ajax({
                    type: "POST",
                    url: "acciones.php",
                    data: {
                        accion: "BuscarColegio",
                        idcategoria: categoria
                    },
                    success: function(data) {
                        console.log(data);
                        $('#tipo2').html(data);
                    }
                });

                //$('#tipo').load('colegios_get.php?colegio_distrito=' + $('#colegio_distrito').val());
            }
        });
    });
</script>