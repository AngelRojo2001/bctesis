<script type="text/javascript">
$(function() {
    $('#form_perfil').validate({
        rules: {
            nombre: {
                required: true
            },
            apellido: {
                required: true
            },
            passwordA: {
                required: true
            },
            passwordN: {
                required: true,
                minlength: 5
            },
            passwordconf: {
                required: true,
                minlength: 5,
                equalTo: "#passwordN"
            }
        }
    });
});
</script>

<?php
$nombre = array(
    'name' => 'nombre',
    'class' => 'form-control',
    'value' => set_value('nombre',isset($usuario)?$usuario['nombre']:''),
    'placeholder' => 'Escriba el nombre'
);
$apellido = array(
    'name' => 'apellido',
    'class' => 'form-control',
    'value' => set_value('apellido',isset($usuario)?$usuario['apellido']:''),
    'placeholder' => 'Escriba el apellido'
);
$passwordA = array(
    'name' => 'passwordA',
    'class' => 'form-control',
    'placeholder' => 'Escriba el password antiguo'
);
$passwordN = array(
    'name' => 'passwordN',
    'id' => 'passwordN',
    'class' => 'form-control',
    'placeholder' => 'Escriba el password nuevo'
);
$passwordconf = array(
    'name' => 'passwordconf',
    'class' => 'form-control',
    'placeholder' => 'Escriba el password nuevo otra vez'
);
$form_perfil = array('id' => 'form_perfil')
?>

<h1><?= $title ?></h1>

<?php if ($this->session->flashdata('password_incorrecto')) { ?>
    <p><?= $this->session->flashdata('password_incorrecto') ?></p>
<?php } ?>

<?php echo validation_errors() ?>
<?php echo form_open($form, $form_perfil) ?>
    <div class="form-group">
        <?php echo form_label('Nombre','nombre',array('class'=>'col-xs-3')) ?>
        <div class="col-xs-9">
            <?php echo form_input($nombre) ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo form_label('Apellido','apellido',array('class'=>'col-xs-3')) ?>
        <div class="col-xs-9">
            <?php echo form_input($apellido) ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo form_label('Password Antiguo','passwordA',array('class'=>'col-xs-3')) ?>
        <div class="col-xs-9">
            <?php echo form_password($passwordA) ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo form_label('Password Nuevo','passwordN',array('class'=>'col-xs-3')) ?>
        <div class="col-xs-9">
            <?php echo form_password($passwordN) ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo form_label('Repita Password','passwordconf',array('class'=>'col-xs-3')) ?>
        <div class="col-xs-9">
            <?php echo form_password($passwordconf) ?>
        </div>
    </div>
    <div>
        <input type="submit" value="<?php echo $title ?>" class="btn btn-success">
    </div>
<?php echo form_close() ?>
