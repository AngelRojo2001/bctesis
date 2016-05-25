<script type="text/javascript">
$(function() {
    $('#form_usuario').validate({
        rules: {
            nombre: {
                required: true
            },
            apellido: {
                required: true
            },
            login: {
                required: true,
                minlength: 5
            },
            categoria: {
                required: true
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
$login['name'] = 'login';
$login['class'] = 'form-control';
$login['value'] = set_value('login',isset($usuario)?$usuario['login']:'');
$login['placeholder'] = 'Escriba el usuario';
if (isset($usuario)) {
    $login['disabled'] = 'disabled';
}
$categoria = array(
    'admin' => 'Administrador',
    'private' => 'Privado',
    'public' => 'Público'
);
$form_usuario = array('id' => 'form_usuario');
?>

<h1><?= $title ?></h1>

<?php if ($this->session->flashdata('login_error')) { ?>
    <p><?= $this->session->flashdata('login_error') ?></p>
<?php } ?>

<?php echo validation_errors() ?>
<?php echo form_open($form, $form_usuario) ?>
    <div class="form-group">
        <?php echo form_label('Nombre','nombre',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10">
            <?php echo form_input($nombre) ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo form_label('Apellido','apellido',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10">
            <?php echo form_input($apellido) ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo form_label('Usuario','login',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10">
            <?php echo form_input($login) ?>
        </div>
        <div id="txtHint"></div>
    </div>
    <div class="form-group">
        <?php echo form_label('Categoria','categoria',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10">
            <?php echo form_dropdown('categoria',$categoria,isset($usuario)?$usuario['categoria']:'private','class="form-control"') ?>
        </div>
    </div>
    <div>
        <input type="submit" value="<?php echo $title ?>" class="btn btn-success">
    </div>
<?php echo form_close() ?>