<h1>REGISTRO</h1>
<p><a href="<?= site_url('registro/crear') ?>" class="btn btn-success btn-block">Añadir</a></p>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
        <thead>
            <tr>
                <th>CODIGO</th>
                <th>AUTOR</th>
                <th>TÍTULO</th>
                <th>CARRERA</th>
                <th>AÑO</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tesis as $registro) { ?>
                <tr>
                    <td><?= $registro['codigo'] ?></td>
                    <td><?= $registro['apellidos'] ?>, <?= $registro['nombres'] ?></td>
                    <td><?= $registro['titulo'] ?></td>
                    <td><?= $registro['carrera'] ?></td>
                    <td><?= $registro['anio'] ?></td>
                    <td>
                        <a href="<?= site_url('registro/pdf/'.$registro['alumno_id']) ?>" class="btn btn-info btn-sm" target="_blank"><span class="glyphicon glyphicon-book"></span></a>
                        <a href="<?= site_url('registro/editar/'.$registro['id']) ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="<?= site_url('registro/borrar/'.$registro['alumno_id']) ?>" class="btn btn-danger btn-sm" id="eliminarItem"><span class="glyphicon glyphicon-trash"></span></a>
                        <a href="<?= site_url('registro/agregar/'.$registro['tesis_id']) ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>