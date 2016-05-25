<script type="text/javascript">
$(function() {
    $('#form_modalidad').validate({
        rules: {
            modalidad: {
                required: true
            }
        }
    });
});
</script>

<?php
$modalidad = array(
    'name' => 'modalidad',
    'class' => 'form-control',
    'value' => isset($modalidad)?$modalidad['modalidad']:'',
    'placeholder' => 'Escriba la modalidad'
);
$form_modalidad = array('id' => 'form_modalidad');
?>

<h1><?= $title ?></h1>

<?php echo validation_errors() ?>
<?php echo form_open($form, $form_modalidad) ?>
    <div class="form-group">
        <?php echo form_label('Modalidad','modalidad') ?>
        <?php echo form_input($modalidad) ?>
    </div>
    <div>
        <input type="submit" value="<?php echo $title ?>" class="btn btn-success">
    </div>
<?php echo form_close() ?>