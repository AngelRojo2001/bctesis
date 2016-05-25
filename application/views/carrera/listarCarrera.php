<h1>CARRERAS</h1>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
        <thead>
            <tr>
                <th>NOMBRE DE LA CARRERA</th>
                <th>NOMBRE DE LA FACULTAD</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($carreras as $carrera): ?>
                <tr>
                    <td><?php echo $carrera['carrera'] ?></td>
                    <td><?php echo $carrera['facultad'] ?></td>
                    <td>
                        <a href="<?php echo site_url('carrera/editar/'.$carrera['id']) ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a id="eliminarItem" href="<?php echo site_url('carrera/borrar/'.$carrera['id']) ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<p><a href="<?php echo site_url('carrera/crear') ?>" class="btn btn-success btn-block">Añadir</a></p>