<script type="text/javascript">
$(function() {
    $('#form_login').validate({
        rules: {
            usuario: {
                required: true,
                minlength: 2,
                maxlength: 150
            },
            contrasena: {
                required: true,
                minlength: 5,
                maxlength: 150
            }
        }
    });
});
</script>
<div class="col-xs-6 col-xs-offset-3 login">
<?php
$login = array(
    'name' => 'usuario',
    'class' => 'form-control',
    'placeholder' => 'Introduzca usuario'
);
$password = array(
    'name' => 'contrasena',
    'class' => 'form-control',
    'placeholder' => 'Password'
);
$form_login = array('id' => 'form_login');
?>
<?php echo validation_errors() ?>
<?php echo form_open('login/new_user',$form_login) ?>
    <div class="form-group">
        <?php echo form_label('Usuario', 'usuario') ?>
        <?php echo form_input($login) ?>
    </div>
    <div class="form-group">
        <?php echo form_label('Password', 'contrasena') ?>
        <?php echo form_password($password) ?>
    </div>
    <div>
        <?php echo form_hidden('token', $token) ?>
        <input type="submit" value="Ingresar" class="btn btn-success">
    </div>
<?php echo form_close() ?>

<?php if ($this->session->flashdata('usuario_incorrecto')) { ?>
    <p><?= $this->session->flashdata('usuario_incorrecto') ?></p>
<?php } ?>
