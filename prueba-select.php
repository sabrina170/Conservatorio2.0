<?php include('header-link.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>

</head>

<script type="text/javascript">
    $(function() {
        $('#eventosDia').on('hidden.bs.modal', function(e) {
            console.log("Modal hidden");
            // $("#placeholder-div1").html("");
            // $('#eventosDia').removeData("modal");
            $('#titulo').val('');
        });
    });
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

<body>
    <select id="profe_e" class="js-example-basic-single form-control orm-control-lg" onchange="buscarprofe2();">
        <option value="" selected>Selecciona un Profesor</option>
        <option value="">Sa</option>
        <option value="">sa</option>
        <option value="">wq</option>
        <option value="">wq</option>
        <option value="">wq</option>

    </select>

    <button type="button" onclick="Evento()" class="btn btn-primary">Crear Clase</button>
    <button type="button" onclick="EventoRecurrente()" class="btn btn-secondary">Crear Clase Recurrente</button>
    <div id='calendar'></div>
    <script>
        function select2(size) {
            $("select").each(function() {
                $(this).select2({
                    theme: "bootstrap-4",
                    width: $(this).data("width") ? $(this).data("width") : $(this).hasClass("w-100") ? "100%" : "style",
                    placeholder: $(this).data("placeholder"),
                    allowClear: Boolean($(this).data("allow-clear")),
                    closeOnSelect: !$(this).attr("multiple"),
                    containerCssClass: size == "small" || size == "large" ? "select2--" + size : "",
                    selectionCssClass: size == "small" || size == "large" ? "select2--" + size : "",
                    dropdownCssClass: size == "small" || size == "large" ? "select2--" + size : "",
                });
            });
        }

        select2()

        var buttons = document.querySelectorAll(".select2-size")

        buttons.forEach(function(button) {
            var id = button.id
            button.addEventListener("click", function(e) {
                e.preventDefault()
                select2(id)
                document.querySelectorAll(".select2-size").forEach(function(item) {
                    item.classList.remove("active")
                })

                this.classList.add("active")
            })
        })
    </script>
</body>

</html>