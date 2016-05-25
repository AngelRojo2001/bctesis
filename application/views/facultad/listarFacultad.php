<h1>FACULTADES</h1>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
        <thead>
            <tr>
                <th>NOMBRE DE LA FACULTAD</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($facultades as $facultad): ?>
                <tr>
                    <td><?php echo $facultad['facultad'] ?></td>
                    <td>
                        <a href="<?php echo site_url('facultad/editar/'.$facultad['id']) ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a id="eliminarItem" href="<?php echo site_url('facultad/borrar/'.$facultad['id']) ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<p><a href="<?php echo site_url('facultad/crear') ?>" class="btn btn-success btn-block">Añadir</a></p>