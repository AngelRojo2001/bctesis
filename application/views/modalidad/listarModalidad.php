<h1>MODALIDADES</h1>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
        <thead>
            <tr>
                <th>NOMBRE DE LA MODALIDAD</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($modalidades as $modalidad): ?>
                <tr>
                    <td><?php echo $modalidad['modalidad'] ?></td>
                    <td>
                        <a href="<?php echo site_url('modalidad/editar/'.$modalidad['id']) ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a id="eliminarItem" href="<?php echo site_url('modalidad/borrar/'.$modalidad['id']) ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<p><a href="<?php echo site_url('modalidad/crear') ?>" class="btn btn-success btn-block">Añadir</a></p>