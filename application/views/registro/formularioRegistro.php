<script type="text/javascript">
$(function() {
    $('#form_registro').validate({
        rules: {
            codigo: {
                required: true,
                digits: true
            },
            apellidos: {
                required: true
            },
            nombres: {
                required: true
            },
            titulo: {
                required: true
            },
            facultad: {
                required: true
            },
            carrera: {
                required: true
            },
            anio: {
                required: true,
                minlength: 4,
                maxlength: 4,
                digits: true
            },
            paginas: {
                digits: true
            },
            valoracion: {
                digits: true
            },
            modalidad: {
                required: true
            }
        }
    });
});

function selectshow(datos) {
    var pagina = "<?php echo site_url('carrera/listarFacultad') ?>";
    pagina = pagina + "/" + datos;
    var x = $('#listarCarrera');
    x.load(pagina);
    return false;
}
</script>

<?php
$opcFac[''] = 'Seleccione opcion...';
foreach ($facultades as $facultad) {
    $opcFac[$facultad['id']] = $facultad['facultad'];
}
$opcCar[''] = 'Seleccione opcion...';
foreach ($carreras as $carrera) {
    $opcCar[$carrera['id']] = $carrera['carrera'];
}
$opcMod[''] = 'Seleccione opcion...';
foreach ($modalidades as $modalidad) {
    $opcMod[$modalidad['id']] = $modalidad['modalidad'];
}
$form_registro = array('id' => 'form_registro');
?>

<h1><?= $title ?></h1>

<?php echo validation_errors(); ?>

<?php echo form_open($form,$form_registro) ?>
    <div class="form-group">
        <?= form_label('Código','codigo',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10">
            <input type="text" name="codigo" id="codigo" value="<?= set_value('codigo',(isset($registro)?$registro['codigo']:'')) ?>" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <?= form_label('Apellidos','apellidos',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10">
            <input type="text" name="apellidos" id="apellidos" value="<?= set_value('apellidos',(isset($alumno)?$alumno['apellidos']:'')) ?>" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <?= form_label('Nombre(s)','nombres',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10">
            <input type="text" name="nombres" id="nombres" value="<?= set_value('nombres',(isset($alumno)?$alumno['nombres']:'')) ?>" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <?= form_label('Título','titulo',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10">
            <textarea name="titulo" id="titulo" class="form-control"><?= set_value('titulo',(isset($tesis)?$tesis['titulo']:'')) ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <?= form_label('Tutor','tutor',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10">
            <input type="text" name="tutor" id="tutor" value="<?= set_value('tutor',(isset($tesis)?$tesis['tutor']:'')) ?>" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <?= form_label('Facultad','facultad',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10">
            <?= form_dropdown('facultad',$opcFac,(isset($tesis)?$tesis['facultad_id']:''),'class="form-control" onChange="selectshow(this.value);"') ?>
        </div>
    </div>
    <div class="form-group">
        <?= form_label('Carrera','carrera',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10" id="listarCarrera">
            <?= form_dropdown('carrera',$opcCar,(isset($tesis)?$tesis['carrera_id']:''),'class="form-control"') ?>
        </div>
    </div>
    <div class="form-group">
        <?= form_label('Año','anio',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10">
            <input type="text" name="anio" id="anio" value="<?= set_value('anio',(isset($tesis)?$tesis['anio']:'')) ?>" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <?= form_label('Páginas','paginas',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10">
            <input type="text" name="paginas" id="paginas" value="<?= set_value('paginas',(isset($tesis)?$tesis['paginas']:'')) ?>" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <?= form_label('Valoración','valoracion',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10">
            <input type="text" name="valoracion" id="valoracion" value="<?= set_value('valoracion',(isset($tesis)?$tesis['nota']:'')) ?>" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <?= form_label('Modalidad','modalidad',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10">
            <?= form_dropdown('modalidad',$opcMod,(isset($tesis)?$tesis['modalidad_id']:''),'id="modalidad" class="form-control"') ?>
        </div>
    </div>
    <div>
        <input type="submit" value="<?= $title ?>" class="btn btn-success">
    </div>
</form>