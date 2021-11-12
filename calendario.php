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
e2.nombres AS nombre_alu,e2.apellidos  AS apellido_alu,e.curso,e.color,e.textColor,e.id_zoom,e.psw_zoom,
e.fecha_start,e.fecha_end,e.link,e.fecha
FROM eventos e
JOIN adminuser e1 ON e.id_profe = e1.id
JOIN adminuser e2 ON e.id_alumno = e2.id where e1.id= '$id_user'");

    $eventos_re = $cn->query("SELECT e.id, e1.nombres AS nombre_pro,e1.apellidos AS apellido_pro,
e2.nombres AS nombre_alu,e2.apellidos  AS apellido_alu,e.curso,e.color,e.textColor,e.id_zoom,e.psw_zoom,
e.fecha_start,e.fecha_end,e.link,e.hora_ini,e.hora_fin,e.dias
FROM eventos_re e
JOIN adminuser e1 ON e.id_profe = e1.id
JOIN adminuser e2 ON e.id_alumno = e2.id where e1.id= '$id_user'");
} else if ($tipo == 4) {
    $eventos = $cn->query("SELECT e.id,e.fecha, e1.nombres AS nombre_pro,e1.apellidos AS apellido_pro,
e2.nombres AS nombre_alu,e2.apellidos  AS apellido_alu,e.curso,e.color,e.textColor,e.id_zoom,e.psw_zoom,
e.fecha_start,e.fecha_end,e.link
FROM eventos e
JOIN adminuser e1 ON e.id_profe = e1.id
JOIN adminuser e2 ON e.id_alumno = e2.id where e2.id= '$id_user'");
    $eventos_re = $cn->query("SELECT e.id, e1.nombres AS nombre_pro,e1.apellidos AS apellido_pro,
e2.nombres AS nombre_alu,e2.apellidos  AS apellido_alu,e.curso,e.color,e.textColor,e.id_zoom,e.psw_zoom,
e.fecha_start,e.fecha_end,e.link,e.hora_ini,e.hora_fin,e.dias
FROM eventos_re e
JOIN adminuser e1 ON e.id_profe = e1.id
JOIN adminuser e2 ON e.id_alumno = e2.id where e2.id= '$id_user'");
} else {
    $eventos = $cn->query("SELECT e.id,e.fecha, e1.nombres AS nombre_pro,e1.apellidos AS apellido_pro,
    e2.nombres AS nombre_alu,e2.apellidos  AS apellido_alu,e.curso,e.color,e.textColor,e.id_zoom,e.psw_zoom,
    e.fecha_start,e.fecha_end,e.link
    FROM eventos e
    JOIN adminuser e1 ON e.id_profe = e1.id
    JOIN adminuser e2 ON e.id_alumno = e2.id");

    $eventos_re = $cn->query("SELECT e.id, e1.nombres AS nombre_pro,e1.apellidos AS apellido_pro,
    e2.nombres AS nombre_alu,e2.apellidos  AS apellido_alu,e.curso,e.color,e.textColor,e.id_zoom,e.psw_zoom,
    e.fecha_start,e.fecha_end,e.link,e.hora_ini,e.hora_fin,e.dias
    FROM eventos_re e
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
$horaTime = $dt->format("H:i:s");
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
                                echo   $_SESSION['user_nombre'];
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
                            id_event: '<?php echo $show["id"]; ?>',
                            title: '<?php echo $show["curso"]; ?>',
                            profesor: '<?php echo $show["nombre_pro"] . " " . $show['apellido_pro']; ?>',
                            alumno: '<?php echo $show["nombre_alu"] . " " . $show['apellido_alu']; ?>',
                            color: '<?php echo $show["color"]; ?>',
                            textColor: '<?php echo $show["textColor"]; ?>',
                            start: '<?php echo $show["fecha"] . " " . $show["fecha_start"]; ?>',
                            end: '<?php echo $show["fecha"] . " " . $show["fecha_end"]; ?>',
                            horaIni: '<?php echo $show["fecha_start"]; ?>',
                            horaFin: '<?php echo $show["fecha_end"]; ?>',
                            fecha: '<?php echo $show["fecha"]; ?>',
                            link: '<?php echo $show["link"]; ?>',
                            link_zoom: '<?php echo $show["link"]; ?>',
                            id_zoom: '<?php echo $show["id_zoom"]; ?>',
                            psw_zoom: '<?php echo $show["psw_zoom"]; ?>',
                            tipo_event: 1,

                        },
                    <?php } ?>
                    <?php
                    foreach ($eventos_re as $show) {
                    ?> {
                            id_event: '<?php echo $show["id"]; ?>',
                            title: '<?php echo $show["curso"]; ?>',
                            profesor: '<?php echo $show["nombre_pro"] . " " . $show['apellido_pro']; ?>',
                            alumno: '<?php echo $show["nombre_alu"] . " " . $show['apellido_alu']; ?>',
                            color: '<?php echo $show["color"]; ?>',
                            textColor: '<?php echo $show["textColor"]; ?>',
                            startRecur: '<?php echo $show["fecha_start"]; ?>',
                            endRecur: '<?php echo $show["fecha_end"]; ?>',
                            daysOfWeek: '<?php echo $show["dias"]; ?>', // these recurrent events move separately
                            startTime: '<?php echo $show["hora_ini"]; ?>',
                            endTime: '<?php echo $show["hora_fin"]; ?>',
                            fecha_ini: '<?php echo $show["fecha_start"]; ?>',
                            fecha_fin: '<?php echo $show["fecha_end"]; ?>',
                            horaIni: '<?php echo $show["hora_ini"]; ?>',
                            horaFin: '<?php echo $show["hora_fin"]; ?>',
                            link: '<?php echo $show["link"]; ?>',
                            link_zoom: '<?php echo $show["link"]; ?>',
                            tipo_event: 2,
                            id_zoom: '<?php echo $show["id_zoom"]; ?>',
                            psw_zoom: '<?php echo $show["psw_zoom"]; ?>',
                            dias: <?php echo json_encode($show["dias"]); ?>,
                        },
                    <?php } ?>
                ],


                eventClick: function(info) {
                    // info.jsEvent.preventDefault(); // don't let the browser navigate
                    // info.event.extendedProps.descripcion
                    console.log(info.event);

                    var tipo = info.event.extendedProps.tipo_event;
                    if (tipo == 1) {
                        $('#dTipo_event').val(tipo);
                        $('#dFechaCa').html(info.event.startStr);
                        $('#dFecha').val(info.event.extendedProps.fecha);
                        $('#dHoraIni').val(info.event.extendedProps.horaIni);
                        $('#dHoraFin').val(info.event.extendedProps.horaFin);
                        var s2 = document.getElementById("rowfecha");
                        s2.style.display = 'block'
                        var s1 = document.getElementById("rowfecha2");
                        s1.style.display = 'none'
                        var s3 = document.getElementById("rowfecha3");
                        s3.style.display = 'none'
                    } else if (tipo == 2) {
                        var id_dias = info.event.extendedProps.dias;
                        $('#dTipo_event').val(tipo);
                        $('#dFechaCa').html(info.event.startStr);
                        $('#dFechaIni').val(info.event.extendedProps.fecha_ini);
                        $('#dFechaFin').val(info.event.extendedProps.fecha_fin);
                        $('#dHoraIni').val(info.event.extendedProps.horaIni);
                        $('#dHoraFin').val(info.event.extendedProps.horaFin);
                        var s2 = document.getElementById("rowfecha");
                        s2.style.display = 'none'
                        var s1 = document.getElementById("rowfecha2");
                        s1.style.display = 'block'
                        var s3 = document.getElementById("rowfecha3");
                        s3.style.display = 'block'
                        console.log('estos', id_dias);
                        var id_etiquetas = JSON.parse(id_dias);
                        console.log("etiquetas recuperadas");
                        $.each(id_etiquetas, function(key, value) {
                            $('.dia2[value=' + value + ']').prop('checked', true);
                        });

                    }
                    $('#dIdZoom').html(info.event.extendedProps.id_zoom);
                    $('#dPswZoom').html(info.event.extendedProps.psw_zoom);
                    $('#dLinkZoom').html(info.event.extendedProps.link_zoom);
                    $('#dId').val(info.event.extendedProps.id_event);
                    $('#dCurso').html(info.event.title);
                    $('#dProfesor').html(info.event.extendedProps.profesor);
                    $('#dAlumno').html(info.event.extendedProps.alumno);
                    console.log(info.event.startStr);


                    var a = document.getElementById("link");
                    a.setAttribute("href", info.event.extendedProps.link);

                    console.log(info.event.backgroundColor);
                    var cabe2 = document.getElementById("dColor");
                    cabe2.style.backgroundColor = info.event.backgroundColor;

                    $('#eventoDetalle').modal('toggle');
                    return false;

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
                }
                <?php if ($tipo == 1 || $tipo == 3) {
                ?>,

                    dateClick: function(info) {
                        console.log(info);
                        $('#fecha_eve').val(info.dateStr);
                        info.dayEl.style.backgroundColor = '#cccccc';
                        $('#eventosDia').modal('toggle');
                    }
                <?php } ?>,
            });
            calendar.setOption('locale', 'Es');
            calendar.render();
        });
    </script>
    <div class="modal" tabindex="-1" id="evento">
        <div class="modal-dialog modal-dialog-scrollable">
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
                                    <select id="profe_e" class="js-example-basic-single form-control" onchange="buscarprofe();">
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
                            <label for="exampleInputPassword1">Correo</label>
                            <input id="correo_e" type="text" class="form-control" aria-describedby="emailHelp" disabled>
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
                                <div class="col-5">
                                    Fecha
                                    <input id="fecha_e" type="date" class="form-control" value="<?php echo $currentTime ?>">
                                </div>
                                <div class="col-3">
                                    Inicio
                                    <input id="hora_ini_e" type="time" value="<?php echo $horaTime; ?>" class="form-control">
                                </div>
                                <div class="col-3">
                                    Fin
                                    <input id="hora_fin_e" type="time" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Zoom</label>
                                    <a type="submit" id="traerlink" class="btn btn-primary mb-2">Generar link Zoom</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><strong>Credenciales para el Zoom:</strong></label>
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Meeting ID</label>
                                    <input id="id_zoom_e" class="form-control" disabled>
                                </div>
                                <div class="col-6">
                                    <label for="">Meeting Password:</label>
                                    <input id="psw_zoom_e" class="form-control" disabled>
                                </div>

                            </div>
                            <br>
                            <input id="gglink_e" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <input id="color_e" type="hidden">
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

    <div class="modal" tabindex="-1" id="recurrente">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div style="padding: 8px;">
                        <div id="cabezal_3" style="padding: 8px;"></div>
                    </div>
                    <h5 class="modal-title">Crear Clase Recurrente</h5>
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
                                    <select id="profe_3" class="js-example-basic-single form-control " onchange="buscarprofe3();">
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
                                    <input id="curso_3" type="text" class="form-control" aria-describedby="emailHelp" disabled>

                                </div>
                                <div class="col-12">
                                    <label for="exampleInputEmail1">Correo</label>
                                    <input id="correo_3" type="text" class="form-control" aria-describedby="emailHelp" disabled>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Alumno</label>
                            <select id="alum_3" class="js-example-basic-single form-control">
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
                                    <label> Fecha Del</label>
                                    <input id="fecha_ini_3" type="date" class="form-control" value="<?php echo $currentTime ?>">
                                </div>
                                <div class="col-6">
                                    <label> Hasta </label>
                                    <input id="fecha_fin_3" type="date" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">

                                <div class="col-4">
                                    <label> Hora Inicio </label>
                                    <input type="time" class="form-control" id="hora_ini_3">
                                </div>
                                <div class="col-4">
                                    <label> Hora Fin </label>
                                    <input type="time" class="form-control" id="hora_fin_3">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label> Días</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="dia form-check-input" name="1" type="checkbox" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">Lunes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="dia form-check-input" name="2" type="checkbox" value="2">
                                <label class="form-check-label" for="inlineCheckbox2">Martes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="dia form-check-input" name="3" type="checkbox" value="3">
                                <label class="form-check-label" for="inlineCheckbox1">Miercoles</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="dia form-check-input" name="4" type="checkbox" value="4">
                                <label class="form-check-label" for="inlineCheckbox2">Jueves</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="dia form-check-input" name="5" type="checkbox" value="5">
                                <label class="form-check-label" for="inlineCheckbox1">Viernes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="dia form-check-input" name="6" type="checkbox" value="6">
                                <label class="form-check-label" for="inlineCheckbox2">Sábado</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="dia form-check-input" name="7" type="checkbox" value="0">
                                <label class="form-check-label" for="inlineCheckbox1">Domingo</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Zoom</label>
                                    <a type="submit" id="traerlink3" class="btn btn-primary mb-2">Generar link Zoom</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><strong>Credenciales para el Zoom:</strong></label>
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Meeting ID</label>
                                    <input id="id_zoom_3" class="form-control" disabled>
                                </div>
                                <div class="col-6">
                                    <label for="">Meeting Password:</label>
                                    <input id="psw_zoom_3" class="form-control" disabled>
                                </div>

                            </div>
                            <br>
                            <input id="gglink_3" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <input id="color_3" type="hidden">
                        </div>

                        <div class="form-group">
                            <input id="dTipo_event" type="hidden">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <a type="button" id="btnAgregar3" class="btn btn-primary">Guardar</a>
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
                    <h6 class="modal-title" id="dFechaCa"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form>
                        <input type="hidden" id="dId">
                        <input type="hidden" id="dTipo_event">

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

                        <div id="rowfecha" class="form-group">
                            <p><strong>Fecha: </strong>
                                <input type="date" id="dFecha" <?php if ($tipo == 2 || $tipo == 4) {
                                                                    echo 'disabled';
                                                                } ?>>
                            </p>
                        </div>
                        <div id="rowfecha2" class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <p><strong>Del: </strong>
                                        <input type="date" id="dFechaIni" <?php if ($tipo == 2 || $tipo == 4) {
                                                                                echo 'disabled';
                                                                            } ?>>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p><strong>Hasta: </strong>
                                        <input type="date" id="dFechaFin" <?php if ($tipo == 2 || $tipo == 4) {
                                                                                echo 'disabled';
                                                                            } ?>>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <p><strong>Hora Inicio : </strong>
                                        <input type="time" id="dHoraIni" <?php if ($tipo == 2 || $tipo == 4) {
                                                                                echo 'disabled';
                                                                            } ?>>
                                    </p>

                                </div>
                                <div class="col-6">
                                    <p><strong>Hora Fin : </strong>
                                        <input type="time" id="dHoraFin" <?php if ($tipo == 2 || $tipo == 4) {
                                                                                echo 'disabled';
                                                                            } ?>>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div id="rowfecha3" class="form-group">
                            <label> Días</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="dia2 form-check-input" name="1" type="checkbox" value="1" <?php if ($tipo == 2 || $tipo == 4) {
                                                                                                            echo 'disabled';
                                                                                                        } ?>>
                                <label class="form-check-label" for="inlineCheckbox1">Lunes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="dia2 form-check-input" name="2" type="checkbox" value="2" <?php if ($tipo == 2 || $tipo == 4) {
                                                                                                            echo 'disabled';
                                                                                                        } ?>>
                                <label class="form-check-label" for="inlineCheckbox2">Martes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="dia2 form-check-input" name="3" type="checkbox" value="3" <?php if ($tipo == 2 || $tipo == 4) {
                                                                                                            echo 'disabled';
                                                                                                        } ?>>
                                <label class="form-check-label" for="inlineCheckbox1">Miercoles</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="dia2 form-check-input" name="4" type="checkbox" value="4" <?php if ($tipo == 2 || $tipo == 4) {
                                                                                                            echo 'disabled';
                                                                                                        } ?>>
                                <label class="form-check-label" for="inlineCheckbox2">Jueves</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="dia2 form-check-input" name="5" type="checkbox" value="5" <?php if ($tipo == 2 || $tipo == 4) {
                                                                                                            echo 'disabled';
                                                                                                        } ?>>
                                <label class="form-check-label" for="inlineCheckbox1">Viernes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="dia2 form-check-input" name="6" type="checkbox" value="6" <?php if ($tipo == 2 || $tipo == 4) {
                                                                                                            echo 'disabled';
                                                                                                        } ?>>
                                <label class="form-check-label" for="inlineCheckbox2">Sábado</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="dia2 form-check-input" name="0" type="checkbox" value="0" <?php if ($tipo == 2 || $tipo == 4) {
                                                                                                            echo 'disabled';
                                                                                                        } ?>>
                                <label class="form-check-label" for="inlineCheckbox1">Domingo</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="color: #06599e;"><strong>Credenciales para el Zoom:</strong></label>
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Meeting ID</label>
                                    <p id="dIdZoom"></p>
                                </div>
                                <div class="col-6">
                                    <label for="">Meeting Password:</label>
                                    <p id="dPswZoom"></p>
                                </div>
                            </div>
                            <label for="">Link:</label>
                            <p id="dLinkZoom"></p>
                            <a id="link" type="submit" class="btn btn-primary mb-2" target="thank">
                                Entrar al link Zoom</a>
                        </div>
                        <div class="form-group">
                            <input id="color" type="hidden">
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <?php if ($tipo == 1 || $tipo == 3) {
                    ?>
                        <a type="button" id="btnActualizar" class="btn btn-success">Actualizar</a>
                        <a type="button" id="btnEliminar" class="btn btn-danger">Eliminar</a>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="eventosDia">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <div style="padding: 8px;">
                        <div id="cabezal_d" style="padding: 8px;"></div>
                    </div>
                    <?php if ($tipo == 1 || $tipo == 3) {
                    ?>
                        <h5 class="modal-title">Crear Clase </h5>
                    <?php } else {
                    ?>
                        <h5 class="modal-title">Tus clases del día</h5>
                    <?php } ?>
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
                                    <select id="profe_d" class="js-example-basic-single form-control" onchange="buscarprofe2();">
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
                                    <input id="curso_d" type="text" class="form-control" aria-describedby="emailHelp" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Correo</label>
                            <input id="correo_d" type="text" class="form-control" aria-describedby="emailHelp" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Alumno</label>
                            <select id="alum_d" class="js-example-basic-single form-control">
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
                                <div class="col-5">
                                    Fecha
                                    <input id="fecha_eve" type="date" class="form-control" disabled>
                                </div>
                                <div class="col-3">
                                    Inicio
                                    <input id="hora_ini_d" type="time" value="<?php echo $horaTime; ?>" class="form-control">
                                </div>
                                <div class="col-3">
                                    Fin
                                    <input id="hora_fin_d" type="time" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Zoom</label>
                                    <a type="submit" id="traerlink2" class="btn btn-primary mb-2">Generar link Zoom</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><strong>Credenciales para el Zoom:</strong></label>
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Meeting ID</label>
                                    <input id="id_zoom_d" class="form-control" disabled>
                                </div>
                                <div class="col-6">
                                    <label for="">Meeting Password:</label>
                                    <input id="psw_zoom_d" class="form-control" disabled>
                                </div>

                            </div>
                            <br>
                            <input id="gglink_d" type="text" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <input id="color_d" type="hidden">
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <?php if ($tipo == 1 || $tipo == 3) {
                    ?>
                        <a type="button" id="btnAgregar2" class="btn btn-primary">Guardar</a>
                    <?php
                    } ?>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    <script>
        $(function() {
            $('#eventoDetalle').on('hidden.bs.modal', function(e) {
                console.log("Modal hidden");
                // $("#placeholder-div1").html("");
                // $('#eventosDia').removeData("modal");
                $('.dia2').prop('checked', false);
                // return false;
            });
        });

        function Evento() {
            $('#evento').modal('toggle');

        }

        function EventoRecurrente() {
            $('#recurrente').modal('toggle');

        }


        $('#btnAgregar3').click(function() {

            var dias = [];
            $('.dia').each(function() {
                if ($(this).is(":checked")) {
                    dias.push($(this).val());
                }
            });
            // console.log(dias)
            var vali = validaciones3();
            if (vali == true) {
                // link = $('#gglink').val();
                // alert(link);
                $.ajax({
                    url: 'acciones.php',
                    type: 'POST',
                    data: {
                        accion: "InsertarEventoRecurrente",
                        curso: $('#curso_3').val(),
                        hora_ini: $('#hora_ini_3').val(),
                        hora_fin: $('#hora_fin_3').val(),
                        fecha_ini: $('#fecha_ini_3').val(),
                        fecha_fin: $('#fecha_fin_3').val(),
                        color: $('#color_3').val(),
                        id_profe: $('#profe_3').val(),
                        id_alum: $('#alum_3').val(),
                        textColor: '#000000',
                        dias: JSON.stringify(dias),
                        link: $('#gglink_3').val()
                    },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                type: 'success',
                                title: 'Clase Recurrente Creada',
                                timer: 1200,
                                showConfirmButton: false
                            }).then(function() {
                                location.href = 'calendario.php';
                            });
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: data,
                                showConfirmButton: false
                            }).then(function() {
                                location.href = 'calendario.php';
                            });
                        }
                    }
                });
            }

        });

        function validaciones2() {
            vProfe = $('#profe_d').val();
            vAlum = $('#alum_d').val();
            vHoraIni = $('#hora_ini_d').val();
            vHoraFin = $('#hora_fin_d').val();
            vLink = $('#gglink_d').val();

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

        function validaciones() {
            vProfe = $('#profe_e').val();
            vAlum = $('#alum_e').val();
            vHoraIni = $('#hora_ini_e').val();
            vHoraFin = $('#hora_fin_e').val();
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
                        curso: $('#curso_e').val(),
                        fecha_start: $('#hora_ini_e').val(),
                        fecha_end: $('#hora_fin_e').val(),
                        fecha: $('#fecha_e').val(),
                        color: $('#color_e').val(),
                        id_profe: $('#profe_e').val(),
                        id_alum: $('#alum_e').val(),
                        textColor: '#000000',
                        link: $('#gglink_e').val(),
                        id_zoom: $('#id_zoom_e').val(),
                        psw_zoom: $('#psw_zoom_e').val(),
                    },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Clase Creada',
                                timer: 1200,
                                showConfirmButton: false
                            }).then(function() {
                                location.href = 'calendario.php';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
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

        function validaciones3() {
            vProfe = $('#profe_3').val();
            vAlum = $('#alum_3').val();
            vHoraIni = $('#hora_ini_3').val();
            vHoraFin = $('#hora_fin_3').val();
            vFechaIni = $('#fecha_ini_3').val();
            vFechaFin = $('#fecha_fin_3').val();
            vLink = $('#gglink_3').val();
            VDias = $(".dia").is(":checked");
            if (vProfe == '') {
                Swal.fire(
                    'Error!',
                    'Seleccione un Profesor!',
                    'error'
                )
                return false;
            } else if (vAlum == '') {
                Swal.fire(
                    'Error!',
                    'Seleccione un Alumno!',
                    'error'
                )
                return false;
            } else if (vFechaIni == '') {
                Swal.fire(
                    'Error!',
                    'Ingresa la Fecha de inicio!',
                    'error'
                )
                return false;
            } else if (vFechaFin == '') {
                Swal.fire(
                    'Error!',
                    'Ingresa la Fecha de Fin!',
                    'error'
                )
                return false;
            } else if (vFechaFin < vFechaIni) {
                Swal.fire(
                    'Error!',
                    'La fecha final debe ser mayor a la fecha inicial!',
                    'error'
                )
                return false;
            } else if (vHoraIni == '') {
                Swal.fire(
                    'Error!',
                    'Ingresa la hora de inicio!',
                    'error'
                )
                return false;
            } else if (vHoraFin == '') {
                Swal.fire(
                    'Error!',
                    'Ingresa la hora de Fin!',
                    'error'
                )
                return false;
            } else if (!VDias) {
                Swal.fire(
                    'Error!',
                    'Por lo menos elejir un dia de semana',
                    'error'
                )
                return false;
            } else if (vLink == '') {
                Swal.fire(
                    'Error!',
                    'Genera link de ZOOM!',
                    'error'
                )
                return false;
            } else {
                return true;
            }


        }


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
                        curso: $('#curso_d').val(),
                        fecha_start: $('#hora_ini_d').val(),
                        fecha_end: $('#hora_fin_d').val(),
                        fecha: $('#fecha_eve').val(),
                        color: $('#color_d').val(),
                        id_profe: $('#profe_d').val(),
                        id_alum: $('#alum_d').val(),
                        textColor: '#000000',
                        link: $('#gglink_d').val(),
                        id_zoom: $('#id_zoom_d').val(),
                        psw_zoom: $('#psw_zoom_d').val(),
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


        $('#btnActualizar').click(function() {
            // alert($('#dId').val());
            var dias = [];
            $('.dia2').each(function() {
                if ($(this).is(":checked")) {
                    dias.push($(this).val());
                }
            });
            $.ajax({
                url: 'acciones.php',
                type: 'POST',
                data: {
                    accion: "ActualizarEvento",
                    hora_ini: $('#dHoraIni').val(),
                    hora_fin: $('#dHoraFin').val(),
                    fecha: $('#dFecha').val(),
                    fecha_ini: $('#dFechaIni').val(),
                    fecha_fin: $('#dFechaFin').val(),
                    id_even: $('#dId').val(),
                    tipo_even: $('#dTipo_event').val(),
                    dias: JSON.stringify(dias),
                },
                success: function(data) {
                    if (data == 1) {
                        Swal.fire({
                            type: 'success',
                            title: 'Clase Actualizada',
                            timer: 1200,
                            showConfirmButton: false
                        }).then(function() {
                            location.href = 'calendario.php';
                        });
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: data,
                            showConfirmButton: false
                        }).then(function() {
                            location.href = 'calendario.php';
                        });
                    }
                }
            });

        });
        $('#btnEliminar').click(function() {
            // alert($('#dId').val());
            // alert($('#dTipo_event').val());
            Swal.fire({
                title: '¿Estas seguro de eliminar esta clase?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'acciones.php',
                        type: 'POST',
                        data: {
                            accion: "EliminarEvento",
                            id_even: $('#dId').val(),
                            tipo_even: $('#dTipo_event').val(),
                        },
                        success: function(data) {
                            if (data == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Clase Eliminada',
                                    timer: 1200,
                                    showConfirmButton: false
                                }).then(function() {
                                    location.href = 'calendario.php';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: data,
                                    showConfirmButton: false
                                }).then(function() {
                                    location.href = 'calendario.php';
                                });
                            }
                        }
                    });
                    // Swal.fire('Eliminado!', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        });

        function buscarprofe2() {
            var profe = $('#profe_d').val();
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

        $('#traerlink').on('click', function(e) {
            e.preventDefault();
            // alert('estoy aqui')

            var correo = $('#correo_e').val();
            var curso = $('#curso_e').val();
            if (correo == '') {
                Swal.fire(
                    'Error!',
                    'El profesor debe tener un correo!',
                    'error'
                )
            } else {
                $.ajax({
                    url: 'Zoom_Api.php',
                    method: 'POST',
                    data: {
                        correo: correo,
                        curso: curso
                    },
                    success: function(data) {
                        // $("#lista_productos tbody").append(data['']);
                        console.log(JSON.parse(data));
                        // console.log(data);
                        PonerDatos4(JSON.parse(data));
                    }
                });
                return false;
            }

        });
        $('#traerlink2').on('click', function(e) {
            e.preventDefault();
            // alert('estoy aqui')

            var correo = $('#correo_d').val();
            var curso = $('#curso_d').val();
            if (correo == '') {
                Swal.fire(
                    'Error!',
                    'El profesor debe tener un correo!',
                    'error'
                )
            } else {
                $.ajax({
                    url: 'Zoom_Api.php',
                    method: 'POST',
                    data: {
                        correo: correo,
                        curso: curso
                    },
                    success: function(data) {
                        // $("#lista_productos tbody").append(data['']);
                        console.log(JSON.parse(data));
                        // console.log(data);
                        PonerDatos6(JSON.parse(data));
                    }
                });
                return false;
            }

        });
        $('#traerlink3').on('click', function(e) {
            e.preventDefault();
            // alert('estoy aqui')

            var correo = $('#correo_3').val();
            var curso = $('#curso_3').val();
            if (correo == '') {
                Swal.fire(
                    'Error!',
                    'El profesor debe tener un correo!',
                    'error'
                )
            } else {
                $.ajax({
                    url: 'Zoom_Api.php',
                    method: 'POST',
                    data: {
                        correo: correo,
                        curso: curso
                    },
                    success: function(data) {
                        // $("#lista_productos tbody").append(data['']);
                        console.log(JSON.parse(data));
                        // console.log(data);
                        PonerDatos5(JSON.parse(data));
                    }
                });
                return false;
            }

        });

        function buscarprofe() {
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
                    PonerDatos(JSON.parse(data));
                }
            });
            return false;
        }

        function buscarprofe3() {
            var profe = $('#profe_3').val();
            $.ajax({
                url: 'buscar_profesor.php',
                method: 'POST',
                data: {
                    profe: profe
                },
                success: function(data) {
                    // $("#lista_productos tbody").append(data['']);
                    console.log(JSON.parse(data));
                    PonerDatos3(JSON.parse(data));
                }
            });
            return false;
        }


        function PonerDatos2(pact) {

            // document.getElementById("nombres").value = pact["nombres"];
            document.getElementById("color_d").value = pact["color"];
            document.getElementById("correo_d").value = pact["correo"];
            document.getElementById("curso_d").value = pact["especialidad"];
            var cabe = document.getElementById("cabezal_d");
            cabe.style.backgroundColor = pact["color"];
            // document.getElementById("color").css = pact["color"];

            // console.log(JSON.stringify(cupon));

        }

        function PonerDatos(pact) {

            document.getElementById("color_e").value = pact["color"];
            document.getElementById("correo_e").value = pact["correo"];
            document.getElementById("curso_e").value = pact["especialidad"];
            var cabe2 = document.getElementById("cabezal_e");
            cabe2.style.backgroundColor = pact["color"];
            // document.getElementById("color").css = pact["color"];

            // console.log(JSON.stringify(cupon));

        }

        function PonerDatos3(pact) {

            document.getElementById("color_3").value = pact["color"];
            document.getElementById("correo_3").value = pact["correo"];
            document.getElementById("curso_3").value = pact["especialidad"];
            var cabe3 = document.getElementById("cabezal_3");
            cabe3.style.backgroundColor = pact["color"];
            // document.getElementById("color").css = pact["color"];

            // console.log(JSON.stringify(cupon));

        }

        function PonerDatos4(pact) {

            document.getElementById("id_zoom_e").value = pact["Id"];
            document.getElementById("psw_zoom_e").value = pact["Psw"];
            document.getElementById("gglink_e").value = pact["Url"];


            // console.log(JSON.stringify(cupon));

        }

        function PonerDatos5(pact) {

            document.getElementById("id_zoom_3").value = pact["Id"];
            document.getElementById("psw_zoom_3").value = pact["Psw"];
            document.getElementById("gglink_3").value = pact["Url"];


            // console.log(JSON.stringify(cupon));

        }

        function PonerDatos6(pact) {

            document.getElementById("id_zoom_d").value = pact["Id"];
            document.getElementById("psw_zoom_d").value = pact["Psw"];
            document.getElementById("gglink_d").value = pact["Url"];


            // console.log(JSON.stringify(cupon));

        }
    </script>