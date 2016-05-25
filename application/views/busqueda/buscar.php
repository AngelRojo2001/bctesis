<?php
$codigo = array(
	'name' => 'codigo',
	'class' => 'form-control',
	'placeholder' => 'Introducir código',
);
$form_codigo = array('id' => 'form_codigo');
$titulo = array(
	'name' => 'titulo',
	'class' => 'form-control',
	'placeholder' => 'Introducir titulo',
);
$form_titulo = array('id' => 'form_titulo');
$autor = array(
	'name' => 'autor',
	'class' => 'form-control',
	'placeholder' => 'Introducir apellido o nombre',
);
$form_autor = array('id' => 'form_autor');
?>
<script type="text/javascript">
$(function() {
    $("#pestanas").tabs();
    $('#form_codigo').validate({
    	rules: {
    		codigo: {
    			required: true,
    			digits: true
    		}
    	}
    });
    $("#btn_codigo").click(function() {
        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            url: $('#form_codigo').attr('action'),
            data: $('#form_codigo').serialize(),
            success: llegadaDatos,
            error: problemas
        });
        return false;
    });
    $("#btn_titulo").click(function() {
        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            url: $('#form_titulo').attr('action'),
            data: $('#form_titulo').serialize(),
            success: llegadaDatos,
            error: problemas
        });
        return false;
    });
    $("#btn_autor").click(function() {
        $.ajax({
            async: true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            url: $('#form_autor').attr('action'),
            data: $('#form_autor').serialize(),
            success: llegadaDatos,
            error: problemas
        });
        return false;
    });
});

function llegadaDatos(datos) {
    $('#resultadoBusqueda').html(datos);
}

function problemas() {
    $('#resultadoBusqueda').text('No se encontraron coincidencias');
}
</script>
<div id="pestanas">
	<ul>
		<li><a href="#pestana1">CÓDIGO</a></li>
		<li><a href="#pestana2">TITULO</a></li>
		<li><a href="#pestana3">AUTOR</a></li>
	</ul>
	<div id="pestana1">
		<?php echo form_open('busqueda/codigo',$form_codigo) ?>
		<div class="form-group">
		    <?php echo form_label('Código','codigo') ?>
	    	<?php echo form_input($codigo) ?>
		</div>
		<div>
		    <input type="submit" value="<?php echo $title ?>" class="btn btn-success btn-block" id="btn_codigo">
		</div>
		<?php echo form_close() ?>
	</div>
	<div id="pestana2">
		<?php echo form_open('busqueda/titulo',$form_titulo) ?>
		<div class="form-group">
		    <?php echo form_label('Titulo','titulo') ?>
		    <?php echo form_input($titulo) ?>
		</div>
		<div>
		    <input type="submit" value="<?php echo $title ?>" class="btn btn-success btn-block" id="btn_titulo">
		</div>
		<?php echo form_close() ?>
	</div>
	<div id="pestana3">
		<?php echo form_open('busqueda/autor',$form_autor) ?>
		<div class="form-group">
		    <?php echo form_label('Autor','autor') ?>
	    	<?php echo form_input($autor) ?>
		</div>
		<div>
		    <input type="submit" value="<?php echo $title ?>" class="btn btn-success btn-block" id="btn_autor">
		</div>
		<?php echo form_close() ?>
	</div>
</div>
<div id="resultadoBusqueda"></div>