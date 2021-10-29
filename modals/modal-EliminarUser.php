<div class="modal fade" id="Eliminar<?php echo $show['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="controlador/acciones.php?accion=EliminarUsuario" method="post">
                <div class="modal-body">
                    <h5>¿Estas seguro que deseas eliminar este usuario?</h5>
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $show['id'] ?>" required />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" <?php echo false; ?>>Cerrar</button>
                    <button name="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>