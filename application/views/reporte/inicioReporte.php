<?php
foreach ($facultades as $facultad) {
    $opcFac[$facultad['id']] = $facultad['facultad'];
}
$anio_facultad = array(
    'name' => 'anio_facultad',
    'id' => 'anio_facultad',
    'class' => 'form-control',
    'placeholder' => 'Año',
);
$form_facultad = array('id' => 'form_facultad');
$anio = array(
    'name' => 'anio',
    'id' => 'anio',
    'class' => 'form-control',
    'placeholder' => 'Introducir Año',
);
$form_anio = array('id' => 'form_anio');
$mes_anio = array(
    'name' => 'mes_anio',
    'id' => 'mes_anio',
    'class' => 'form-control',
    'placeholder' => 'Introducir Año',
);
$meses = array(
    '1' => 'Enero',
    '2' => 'Febrero',
    '3' => 'Marzo',
    '4' => 'Abril',
    '5' => 'Mayo',
    '6' => 'Junio',
    '7' => 'Julio',
    '8' => 'Agosto',
    '9' => 'Septiembre',
    '10' => 'Octubre',
    '11' => 'Noviembre',
    '12' => 'Diciembre',
);
$form_mes = array('id' => 'form_mes');
$graficos = array(
    '1' => 'Barras',
    '2' => 'Lineas',
    '3' => 'Radar',
    '4' => 'Donas',
    '5' => 'Pie',
    '6' => 'Polar',
);
?>
<script type="text/javascript">
$(function() {
    $("#pestanas").tabs();
    $('#form_facultad').validate({
        rules: {
            anio_facultad: {
                required: true,
                digits: true,
                minlength: 4,
                maxlength: 4
            }
        }
    });
    $('#form_anio').validate({
        rules: {
            anio: {
                required: true,
                digits: true,
                minlength: 4,
                maxlength: 4
            }
        }
    });
    $('#form_mes').validate({
        rules: {
            mes_anio: {
                required: true,
                digits: true,
                minlength: 4,
                maxlength: 4
            }
        }
    });
    $('#mostrarGraficos').dialog({
        autoOpen: false,
        width: 700,
        resizable: false,
        modal: true,
    });
     $('#btn_est_facultad').click(function() {
        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            url: "<?= site_url('reporte/graficoByFacultad') ?>",
            data: $('#form_facultad').serialize(),
            success: llegadaDatos,
            error: problemas
        });
        return false;
    });
    $('#btn_est_anio').click(function() {
        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            url: "<?= site_url('reporte/graficoByAnio') ?>",
            data: $('#form_anio').serialize(),
            success: llegadaDatos,
            error: problemas
        });
        return false;
    });
    $('#btn_est_mes').click(function() {
        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            url: "<?= site_url('reporte/graficoByMes') ?>",
            data: $('#form_mes').serialize(),
            success: llegadaDatos,
            error: problemas
        });
        return false;
    });
});

function llegadaDatos(datos) {
    $('#mostrarGraficos').dialog('open');
    $('#dibujoCanvas').html(datos);
}

function problemas() {
    $('#dibujoCanvas').text('No se encontraron coincidencias');
}
</script>
<div id="pestanas">
    <ul>
        <li><a href="#pestana1">FACULTAD</a></li>
        <li><a href="#pestana2">AÑO</a></li>
        <li><a href="#pestana3">MES</a></li>
    </ul>
    <div id="pestana1">
        <?php echo form_open('reporte/facultad', $form_facultad) ?>
            <div class="form-group">
                <?= form_label('Facultad','facultad',array('class'=>'col-xs-2')) ?>
                <div class="col-xs-5">
                    <?php echo form_dropdown('facultad',$opcFac,'','class="form-control"') ?>
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-5 col-xs-offset-2">
                    <?php echo form_input($anio_facultad) ?>
                </div>
                <div class="col-xs-5">
                    <input type="submit" value="<?php echo $title ?>" class="btn btn-success btn-block" id="btn_facultad">
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <?= form_label('Gráficos','graficosFacultad',array('class'=>'col-xs-2')) ?>
                <div class="col-xs-5">
                    <?php echo form_dropdown('graficosFacultad',$graficos,'','class="form-control"') ?>
                </div>
                <div class="col-xs-5">
                    <input type="button" value="Gráficos" class="btn btn-success btn-block" id="btn_est_facultad">
                </div>
            </div>
            <div class="clearfix"></div>
        <?php echo form_close() ?>
    </div>
    <div id="pestana2">
        <?php echo form_open('reporte/anio',$form_anio) ?>
            <div class="form-group">
                <?= form_label('Año','anio',array('class'=>'col-xs-2')) ?>
                <div class="col-xs-5">
                    <?php echo form_input($anio) ?>
                </div>
                <div class="col-xs-5">
                    <input type="submit" value="<?php echo $title ?>" class="btn btn-success btn-block" id="btn_anio">
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <?= form_label('Gráficos','graficosAnio',array('class'=>'col-xs-2')) ?>
                <div class="col-xs-5">
                    <?php echo form_dropdown('graficosAnio',$graficos,'','class="form-control"') ?>
                </div>
                <div class="col-xs-5">
                    <input type="button" value="Gráficos" class="btn btn-success btn-block" id="btn_est_anio">
                </div>
            </div>
            <div class="clearfix"></div>
        <?php echo form_close() ?>
    </div>
    <div id="pestana3">
        <?php echo form_open('reporte/mes',$form_mes) ?>
            <div class="form-group">
                <?= form_label('Mes','mes',array('class'=>'col-xs-2')) ?>
                <div class="col-xs-5">
                    <?php echo form_dropdown('mes', $meses,'','class="form-control"') ?>
                </div>
                <div class="clearfix"></div>
                <?php echo form_label('Año','mes_anio',array('class'=>'col-xs-2')) ?>
                <div class="col-xs-5">
                    <?php echo form_input($mes_anio) ?>
                </div>
                <div class="col-xs-5">
                    <input type="submit" value="<?php echo $title ?>" class="btn btn-success btn-block" id="btn_anio">
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <?= form_label('Gráficos','graficosMes',array('class'=>'col-xs-2')) ?>
                <div class="col-xs-5">
                    <?php echo form_dropdown('graficosMes',$graficos,'','class="form-control"') ?>
                </div>
                <div class="col-xs-5">
                    <input type="button" value="Gráficos" class="btn btn-success btn-block" id="btn_est_mes">
                </div>
            </div>
            <div class="clearfix"></div>
        <?php echo form_close() ?>
    </div>
</div>
<div id="mostrarGraficos" title="Gráficos">
    <div id="dibujoCanvas"></div>
</div>