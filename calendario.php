<?php include('header-link.php');
if (!isset($_SESSION['user_tipo'])) {
    header('Location:index.php?nt=0');
} else {
}
include('header.php');
include('controlador/conexion.php');
$id_user = $_SESSION['user_id'];
$tipo = $_SESSION['user_tipo'];
if ($tipo == 2) {
    $eventos = $cn->query("SELECT e.id,e.fecha, e1.nombres AS nombre_pro,e1.apellidos AS apellido_pro,
e2.nombres AS nombre_alu,e2.apellidos  AS apellido_alu,e.curso,e.color,e.textColor,
e.fecha_start,e.fecha_end,e.link,e.fecha
FROM eventos e
JOIN adminuser e1 ON e.id_profe = e1.id
JOIN adminuser e2 ON e.id_alumno = e2.id where e1.id= '$id_user'");
} else if ($tipo == 4) {
    $eventos = $cn->query("SELECT e.id,e.fecha, e1.nombres AS nombre_pro,e1.apellidos AS apellido_pro,
e2.nombres AS nombre_alu,e2.apellidos  AS apellido_alu,e.curso,e.color,e.textColor,
e.fecha_start,e.fecha_end,e.link
FROM eventos e
JOIN adminuser e1 ON e.id_profe = e1.id
JOIN adminuser e2 ON e.id_alumno = e2.id where e2.id= '$id_user'");
} else {
    $eventos = $cn->query("SELECT e.id,e.fecha, e1.nombres AS nombre_pro,e1.apellidos AS apellido_pro,
    e2.nombres AS nombre_alu,e2.apellidos  AS apellido_alu,e.curso,e.color,e.textColor,
    e.fecha_start,e.fecha_end,e.link
    FROM eventos e
    JOIN adminuser e1 ON e.id_profe = e1.id
    JOIN adminuser e2 ON e.id_alumno = e2.id");
}

$profesores = $cn->query("SELECT * FROM adminuser where tipo = 2 order by nombres asc");
$alumnos = $cn->query("SELECT * FROM adminuser where tipo = 4 order by nombres asc");

$dtz = new DateTimeZone("America/Lima");
$dt = new DateTime("now", $dtz);

//Stores time as "2021-04-04T13:35:48":
// $currentTime = $dt->format("Y-m-d") . "T" . $dt->format("H:i:s");
$currentTime = $dt->format("Y-m-d");
// echo $currentTime;
// echo json_encode($eventos);
?>
<style>
    #calendar {
        /* max-width: 1300px; */
    }
</style>
<div class="content-wrapper" style="padding: 0px 30px 30px 30px; background-color: #e0e0e0;">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="text-center m-0" style="color: #06599e;">Calendario de <strong>
                            <?php
                            if ($tipo == 1 || $tipo == 3) {
                                echo 'Clases';
                            } else {
                                $_SESSION['user_nombre'];
                            } ?> </strong> </h1>
                </div>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },

                // Añadir color al evento

                events: [
                    <?php
                    foreach ($eventos as $show) {
                    ?> {
                            id: '<?php echo $show["id"]; ?>',
                            title: '<?php echo $show["curso"]; ?>',
                            profesor: '<?php echo $show["nombre_pro"] . " " . $show['apellido_pro']; ?>',
                            alumno: '<?php echo $show["nombre_alu"] . " " . $show['apellido_alu']; ?>',
                            color: '<?php echo $show["color"]; ?>',
                            textColor: '<?php echo $show["textColor"]; ?>',
                            start: '<?php echo $show["fecha"] . " " . $show["fecha_start"]; ?>',
                            end: '<?php echo $show["fecha"] . " " . $show["fecha_end"]; ?>',
                            link: '<?php echo $show["link"]; ?>',
                            horaIni: '<?php echo $show["fecha_start"]; ?>',
                            horaFin: '<?php echo $show["fecha_end"]; ?>',
                            fecha: '<?php echo $show["fecha"]; ?>',
                        },
                    <?php } ?>
                    // {
                    //     id: 2,
                    //     title: 'evento recurrente',
                    //     profesor: '1',
                    //     alumno: '2',
                    //     color: 'red',
                    //     textColor: '#000000',
                    //     startRecur: '2021-11-01',
                    //     endRecur: '2021-12-01',
                    //     daysOfWeek: ['3', '4'], // these recurrent events move separately
                    //     startTime: '11:00:00',
                    //     endTime: '11:30:00',
                    // }
                ],


                eventClick: function(info) {
                    // info.jsEvent.preventDefault(); // don't let the browser navigate
                    // info.event.extendedProps.descripcion
                    console.log(info.event);
                    // if (info.event.url) {
                    // window.open(info.event.url);
                    // }
                    $('#dCurso').html(info.event.title);
                    $('#dProfesor').html(info.event.extendedProps.profesor);
                    $('#dAlumno').html(info.event.extendedProps.alumno);
                    console.log(info.event.startStr);
                    $('#dfecha').html(info.event.startStr);
                    $('#dHoraIni').html(info.event.extendedProps.horaIni);
                    $('#dHoraFin').html(info.event.extendedProps.horaFin);
                    var a = document.getElementById("link");
                    a.setAttribute("href", info.event.extendedProps.link);

                    console.log(info.event.backgroundColor);
                    var cabe2 = document.getElementById("dColor");
                    cabe2.style.backgroundColor = info.event.backgroundColor;

                    $('#eventoDetalle').modal('toggle');

                },
                customButtons: {
                    Miboton: {
                        text: "Crear Clase",
                        click: function() {
                            $('#evento').modal('toggle');
                        }
                    },
                    Miotroevento: {
                        text: "Crear Clase Recurrente",
                        click: function() {
                            $('#eventoRecurrente').modal('toggle');
                        }
                    }
                },
                dateClick: function(info) {
                    // console.log(info.event);
                    $('#fecha_eve').val(info.dateStr);
                    info.dayEl.style.backgroundColor = '#cccccc';
                    $('#eventosDia').modal('toggle');
                },




            });
            calendar.setOption('locale', 'Es');
            calendar.render();
        });
    </script>
    <div class="modal" tabindex="-1" id="evento">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <div style="padding: 8px;">
                        <div id="cabezal_e" style="padding: 8px;"></div>
                    </div>
                    <h5 class="modal-title">Crear Clase</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="exampleInputPassword1">Profesor</label>
                                    <select id="profe_e" class="js-example-basic-single form-control " onchange="buscarprofe2();">
                                        <option value="" selected>Selecciona un Profesor</option>
                                        <?php
                                        foreach ($profesores as $prof) {
                                        ?>
                                            <option value="<?php echo $prof['id'] ?>"><?php echo $prof['nombres'], ' ', $prof['apellidos'] ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="exampleInputEmail1">Curso</label>
                                    <input id="curso_e" type="text" class="form-control" aria-describedby="emailHelp" disabled>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Alumno</label>
                            <select id="alum_e" class="js-example-basic-single form-control">
                                <option value="" selected>Selecciona un Alumno</option>
                                <?php
                                foreach ($alumnos as $alum) {
                                ?>
                                    <option value="<?php echo $alum['id'] ?>"><?php echo $alum['nombres'], ' ', $alum['apellidos'] ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    Fecha
                                    <input id="fecha_eve_e" type="date" class="form-control" value="<?php echo $currentTime ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">

                                <div class="col-4">
                                    Inicio
                                    <input type="time" class="form-control" id="hora_start_e">
                                </div>
                                <div class="col-4">
                                    Fin
                                    <input type="time" class="form-control" id="hora_end_e">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Zoom</label>
                                    <button type="submit" class="btn btn-primary mb-2">Generar link Zoom</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input id="gglink_e" type="text" class="form-control" value="https://zoom.us/j/97666123210?pwd=SUlVRjV6VTZHdTZOYiszRE84NDZGdz09" disabled>
                        </div>
                        <div class="form-group">
                            <input id="color_e" type="hidden">
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <a type="button" id="btnAgregar2" class="btn btn-primary">Guardar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="eventoDetalle">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div style="padding: 4px;">
                        <div id="dColor" style="padding: 8px;"></div>
                    </div>

                    <h6 class="modal-title" id="dfecha"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <p><strong>Curso : </strong>
                                <em id="dCurso"></em>
                            </p>
                        </div>

                        <div class="form-group">
                            <p><strong>Profesor : </strong>
                                <em id="dProfesor"></em>
                            </p>
                        </div>
                        <div class="form-group">
                            <p><strong>Alumno : </strong>
                                <em id="dAlumno"></em>
                            </p>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <p><strong>Hora Inicio : </strong>
                                        <sm id="dHoraIni"></sm>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p><strong>Hora Fin : </strong>
                                        <sm id="dHoraFin"></sm>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Entrar</label>
                                    <a id="link" type="submit" class="btn btn-primary mb-2" target="thank">
                                        Link Zoom</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input id="color" type="hidden">
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="eventosDia">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <div style="padding: 8px;">
                        <div id="cabezal" style="padding: 8px;"></div>
                    </div>
                    <h5 class="modal-title">Crear Clase </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Profesor</label>
                            <select id="profe" class="js-example-basic-single form-control" onchange="buscarprofe();" required>
                                <option value="" selected>Selecciona un Profesor</option>
                                <?php
                                foreach ($profesores as $prof) {
                                ?>
                                    <option value="<?php echo $prof['id'] ?>"><?php echo $prof['nombres'], ' ', $prof['apellidos'] ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Alumno</label>
                            <select id="alum" class="js-example-basic-single form-control">
                                <option value="" selected>Selecciona un Alumno</option>
                                <?php
                                foreach ($alumnos as $alum) {
                                ?>
                                    <option value="<?php echo $alum['id'] ?>"><?php echo $alum['nombres'], ' ', $alum['apellidos'] ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Curso</label>
                            <input id="curso" type="text" class="form-control" aria-describedby="emailHelp" disabled>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">
                                    Fecha:
                                    <input type="text" class="form-control" id="fecha_eve" disabled>
                                </div>
                                <div class="col-4">
                                    Inicio
                                    <input type="time" class="form-control" id="hora_start">
                                </div>
                                <div class="col-4">
                                    Fin
                                    <input type="time" class="form-control" id="hora_end">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="">

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Zoom</label>
                                    <button type="submit" class="btn btn-primary mb-2">Generar link Zoom</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input id="gglink" type="text" class="form-control" value="https://zoom.us/j/97666123210?pwd=SUlVRjV6VTZHdTZOYiszRE84NDZGdz09">
                        </div>
                        <div class="form-group">
                            <input id="color" type="hidden">
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <a type="button" id="btnAgregar" class="btn btn-primary">Guardar</a>
                </div>
            </div>
        </div>
    </div>
    <?php if ($tipo == 1 || $tipo == 3) {
    ?>
        <button type="button" onclick="Evento()" class="btn btn-primary">Crear Clase</button>
        <button type="button" onclick="EventoRecurrente()" class="btn btn-secondary">Crear Clase Recurrente</button>

    <?php
    } ?>
    <br>
    <div id='calendar' style="background-color: white;padding: 10px;margin-top: 10px;"></div>
    <?php include('footer.php'); ?>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        function Evento() {
            $('#evento').modal('toggle');

        }

        function EventoRecurrente() {
            $('#recurrente').modal('toggle');

        }

        function validaciones() {
            vProfe = $('#profe').val();
            vAlum = $('#alum').val();
            vHoraIni = $('#hora_start').val();
            vHoraFin = $('#hora_end').val();
            vLink = $('#gglink').val();

            if (vProfe == '') {
                Swal.fire(
                    'Error!',
                    'Seleccione un Profesor!',
                    'error'
                )

            } else if (vAlum == '') {
                Swal.fire(
                    'Error!',
                    'Seleccione un Alumno!',
                    'error'
                )
            } else if (vHoraIni == '') {
                Swal.fire(
                    'Error!',
                    'Ingresa la hora de inicio!',
                    'error'
                )
            } else if (vHoraFin == '') {
                Swal.fire(
                    'Error!',
                    'Ingresa la hora de Fin!',
                    'error'
                )
            } else if (vLink == '') {
                Swal.fire(
                    'Error!',
                    'Genera link de ZOOM!',
                    'error'
                )
            } else {
                return true;
            }


        }

        function validaciones2() {
            vProfe = $('#profe_e').val();
            vAlum = $('#alum_e').val();
            vHoraIni = $('#hora_start_e').val();
            vHoraFin = $('#hora_end_e').val();
            vLink = $('#gglink_e').val();

            if (vProfe == '') {
                Swal.fire(
                    'Error!',
                    'Seleccione un Profesor!',
                    'error'
                )

            } else if (vAlum == '') {
                Swal.fire(
                    'Error!',
                    'Seleccione un Alumno!',
                    'error'
                )
            } else if (vHoraIni == '') {
                Swal.fire(
                    'Error!',
                    'Ingresa la hora de inicio!',
                    'error'
                )
            } else if (vHoraFin == '') {
                Swal.fire(
                    'Error!',
                    'Ingresa la hora de Fin!',
                    'error'
                )
            } else if (vLink == '') {
                Swal.fire(
                    'Error!',
                    'Genera link de ZOOM!',
                    'error'
                )
            } else {
                return true;
            }


        }

        $('#btnAgregar').click(function() {
            // alert('dasdasd');
            var vali = validaciones();
            if (vali == true) {
                // link = $('#gglink').val();
                // alert(link);
                $.ajax({
                    url: 'acciones.php',
                    type: 'POST',
                    data: {
                        accion: "InsertarEvento",
                        curso: $('#curso').val(),
                        fecha_start: $('#hora_start').val(),
                        fecha_end: $('#hora_end').val(),
                        fecha: $('#fecha_eve').val(),
                        color: $('#color').val(),
                        id_profe: $('#profe').val(),
                        id_alum: $('#alum').val(),
                        textColor: '#000000',
                        link: $('#gglink').val()
                    },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                type: 'success',
                                title: 'Clase Creada',
                                timer: 1200,
                                showConfirmButton: false
                            }).then(function() {
                                location.href = 'calendario.php';
                            });
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: data,
                                timer: 1200,
                                showConfirmButton: false
                            }).then(function() {
                                location.href = 'calendario.php';
                            });
                        }
                    }
                });
            }
        });
        $('#btnAgregar2').click(function() {
            // alert('dasdasd');
            var vali = validaciones2();
            if (vali == true) {
                // link = $('#gglink').val();
                // alert(link);
                $.ajax({
                    url: 'acciones.php',
                    type: 'POST',
                    data: {
                        accion: "InsertarEvento",
                        curso: $('#curso_e').val(),
                        fecha_start: $('#hora_start_e').val(),
                        fecha_end: $('#hora_end_e').val(),
                        fecha: $('#fecha_eve_e').val(),
                        color: $('#color_e').val(),
                        id_profe: $('#profe_e').val(),
                        id_alum: $('#alum_e').val(),
                        textColor: '#000000',
                        link: $('#gglink_e').val()
                    },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                type: 'success',
                                title: 'Clase Creada',
                                timer: 1200,
                                showConfirmButton: false
                            }).then(function() {
                                location.href = 'index.php';
                            });
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: data,
                                timer: 1200,
                                showConfirmButton: false
                            }).then(function() {
                                location.href = 'index.php';
                            });
                        }
                    }
                });
            }
        });

        function buscarprofe() {
            var profe = $('#profe').val();
            $.ajax({
                url: 'buscar_profesor.php',
                method: 'POST',
                data: {
                    profe: profe
                },
                success: function(data) {
                    // $("#lista_productos tbody").append(data['']);
                    console.log(JSON.parse(data));
                    PonerDatos(JSON.parse(data));
                }
            });
            return false;
        }

        function buscarprofe2() {
            var profe = $('#profe_e').val();
            $.ajax({
                url: 'buscar_profesor.php',
                method: 'POST',
                data: {
                    profe: profe
                },
                success: function(data) {
                    // $("#lista_productos tbody").append(data['']);
                    console.log(JSON.parse(data));
                    PonerDatos2(JSON.parse(data));
                }
            });
            return false;
        }

        function PonerDatos(pact) {

            // document.getElementById("nombres").value = pact["nombres"];
            document.getElementById("color").value = pact["color"];
            document.getElementById("curso").value = pact["especialidad"];
            var cabe = document.getElementById("cabezal");
            cabe.style.backgroundColor = pact["color"];
            // document.getElementById("color").css = pact["color"];

            // console.log(JSON.stringify(cupon));

        }

        function PonerDatos2(pact) {

            document.getElementById("color_e").value = pact["color"];
            document.getElementById("curso_e").value = pact["especialidad"];
            var cabe2 = document.getElementById("cabezal_e");
            cabe2.style.backgroundColor = pact["color"];
            // document.getElementById("color").css = pact["color"];

            // console.log(JSON.stringify(cupon));

        }
    </script>