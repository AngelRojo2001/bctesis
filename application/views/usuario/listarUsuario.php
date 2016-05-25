<h1>USUARIOS</h1>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
        <thead>
            <tr>
                <th>NOMBRE</th>
                <th>APELLIDOS</th>
                <th>USUARIO</th>
                <th>CATEGORIA</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo $usuario['nombre'] ?></td>
                    <td><?php echo $usuario['apellido'] ?></td>
                    <td><?php echo $usuario['login'] ?></td>
                    <td><?php echo $usuario['categoria'] ?></td>
                    <td>
                        <a href="<?php echo site_url('usuario/editar/'.$usuario['id']) ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a id="eliminarItem" href="<?php echo site_url('usuario/borrar/'.$usuario['id']) ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<p><a href="<?php echo site_url('usuario/crear') ?>" class="btn btn-success btn-block">Añadir</a></p>