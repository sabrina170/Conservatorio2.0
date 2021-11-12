<?php include('header-link.php');

if (!isset($_SESSION['user_tipo'])) {
    header('Location:index.php?nt=0');
} else {
    if ($_SESSION['user_tipo'] == 2) {
        header('Location:index.php?nt=0');
    } else if ($_SESSION['user_tipo'] == 3) {
        header('Location:index.php?nt=0');
    }
} ?>

<?php include('header.php');
include('controlador/conexion.php');
$nt = $_REQUEST['nt'];
$consulta = "SELECT * FROM adminuser ";
$resultado = mysqli_query($cn, $consulta);
?>
<style>
    .dt-button {
        padding: 0;
        border: none;
        margin-bottom: 10px;
    }
</style>
<div class="content-wrapper" style="padding: 0px 30px 30px 30px; background-color: #e0e0e0;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color: #06599e;"><strong>Usuarios</strong> </h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php
            if ($nt == 1) {
            ?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
                <script>
                    Swal.fire(
                        'Insertado!',
                        'Usuario creado correctamente!',
                        'success'
                    ).then(function() {
                        window.location.href = "admin.php?nt=0";
                    });
                    // window.location.href = "tutoriales.php ";
                </script>
            <?php
            } else if ($nt == 2) {
            ?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
                <script>
                    Swal.fire(
                        'Eliminado!',
                        'Usuario eliminado correctamente!',
                        'error'
                    ).then(function() {
                        window.location.href = "admin.php?nt=0";
                    });
                    // window.location.href = "tutoriales.php ";
                </script>
            <?php
            } else if ($nt == 4) {
            ?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
                <script>
                    Swal.fire(
                        'Error al insertar usuario!',
                        'Problemas!',
                        'warning'
                    ).then(function() {
                        window.location.href = "admin.php?nt=0";
                    });
                    // window.location.href = "tutoriales.php ";
                </script>
            <?php
            } else if ($nt == 6) {
            ?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
                <script>
                    Swal.fire(
                        'Insertar una imagen!',
                        'No otros archivos como(videos,musica,pdf,etc)',
                        'warning'
                    ).then(function() {
                        window.location.href = "admin.php?nt=0";
                    });
                    // window.location.href = "tutoriales.php ";
                </script>
            <?php
            }
            ?>
            <div class="card">
                <div class="card-header">
                    Insertar un usuario
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <form action="controlador/acciones.php?accion=InsertaUsuario" method="POST" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Nombres</label>
                                        <input type="text" class="form-control" name="nombres" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword4">Apellidos</label>
                                        <input type="text" class="form-control" name="apellidos" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword4">DNI</label>
                                        <input type="number" class="form-control" name="dni" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Especialidad</label>
                                        <input type="text" class="form-control" name="especialidad" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Cargo</label>
                                        <select id="inputState" class="form-control" name="tipo" required>
                                            <option value="" selected>Cargo...</option>
                                            <option value="3">Trabajador</option>
                                            <option value="2">Profesor(a)</option>
                                            <option value="1">Administrador</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Telefono</label>
                                        <input type="number" class="form-control" name="telefono" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Usuario</label>
                                        <input type="text" class="form-control" name="usuario" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Contraseña</label>
                                        <input type="text" class="form-control" name="clave" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Estado</label>
                                        <select id="inputState" class="form-control btn-secondary" name="estado" required>
                                            <option value="1" selected>Activo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputEmail4">Correo</label>
                                        <input type="email" class="form-control" name="correo" required>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-2">
                            <label for="inputState">Imagen</label>
                            <img src="assets/img/perfil.png" class="img-thumbnail" id="img1" height="200" width="200">
                            <div class="form-group">
                                <input type="file" class="form-control" name="foto" id="foto" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Insertar</button>
                    </form>
                </div>
            </div>

            <div class="card" style="padding: 10px;">

                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table" id="usuarios">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nr0</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Especialidad</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Cargo</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Contraseña</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Modificado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $posicion = 1;
                            foreach ($resultado as $show) {
                            ?>
                                <tr>
                                    <th>
                                        <?php echo $posicion;
                                        $posicion++ ?>
                                    </th>
                                    <td>
                                        <a href="" type="button" data-toggle="modal" data-target="#exampleModal<?php echo $show['id'] ?>">
                                            <?php if ($show['foto'] != '') {
                                            ?>
                                                <img src="controlador/<?php echo $show['foto'] ?>" width="60" height="60" class="d-inline-block align-top">

                                            <?php } else { ?>
                                                <img src="controlador/imagenes/defecto.png" width="60" height="60" class="d-inline-block align-top">
                                            <?php } ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php echo $show['nombres'] ?>
                                    </td>
                                    <td>
                                        <?php echo $show['apellidos'] ?>
                                    </td>
                                    <td>
                                        <?php echo $show['especialidad'] ?>
                                    </td>
                                    <td>
                                        <?php echo $show['telefono'] ?>
                                    </td>
                                    <td>
                                        <?php if ($show['tipo'] == 1) {
                                            echo '<strong> Administrador</strong>';
                                        } else if ($show['tipo'] == 2) {
                                            echo '<strong> Profesor</strong>';
                                        } else if ($show['tipo'] == 3) {
                                            echo '<strong> Trabajador</strong>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $show['usuario'] ?>
                                    </td>
                                    <td>
                                        <?php echo $show['clave'] ?>
                                    </td>
                                    <td>
                                        <?php echo $show['correo'] ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($show['estado'] == 1) {
                                            echo '<span class="badge rounded-pill bg-success">Activo</span>';
                                        } else {
                                            echo '<span class="badge rounded-pill bg-danger">Desactivado</span>';
                                        }

                                        ?>
                                    </td>
                                    <td>
                                        Por <strong style="color: #06599e;"><?php echo $show['modificado'] ?></strong>
                                    </td>

                                    <td>
                                        <a href="Edit-user.php?id=<?php echo $show['id']; ?>&nt=0"> <i class="fas fa-edit"></i></a>
                                        <a href="" type="button" data-toggle="modal" data-target="#Eliminar<?php echo $show['id'] ?>"><i class="fas fa-trash-alt"></i></a>
                                    </td>

                                </tr>

                            <?php
                                include('modals/modal-fotoUser.php');
                                include('modals/modal-EliminarUser.php');
                            } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
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
                    filename: 'Excel de Usuarios',

                    //Aquí es donde generas el botón personalizado
                    text: '<button class="btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></button>'
                },
                //Botón para PDF
                {
                    extend: 'pdf',
                    footer: true,
                    title: 'Archivo PDF',
                    filename: 'Pdf de Usuarios',
                    text: '<button class="btn btn-danger">Exportar a PDF <i class="far fa-file-pdf"></i></button>'
                },
                {
                    extend: 'print',
                    footer: true,
                    title: 'Imprimir',
                    filename: 'Archivo Usuarios',
                    text: '<button class="btn btn-info">Imprimir <i class="fas fa-print"></i></button>'
                }

            ]

        });
    });
</script>
<script>
    function init() {
        var inputFile = document.getElementById('foto');
        inputFile.addEventListener('change', mostrarImagen, false);
    }

    function mostrarImagen(event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function(event) {
            var img = document.getElementById('img1');
            img.src = event.target.result;
        }
        reader.readAsDataURL(file);
    }

    window.addEventListener('load', init, false);
</script>