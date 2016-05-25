<script type="text/javascript">
$(function() {
    $('#form_carrera').validate({
        rules: {
            carrera: {
                required: true
            }
        }
    });
});
</script>

<?php
$carrera1 = array(
    'name' => 'carrera',
    'class' => 'form-control',
    'value' => isset($carrera)?$carrera['carrera']:'',
    'placeholder' => 'Escriba la Carrera'
);
foreach ($facultades as $facultad) {
    $options[$facultad['id']] = $facultad['facultad'];
}
$form_carrera = array('id' => 'form_carrera');
?>

<h1><?php echo $title ?></h1>

<?php echo validation_errors(); ?>
<?php echo form_open($form, $form_carrera) ?>
    <div class="form-group">
        <?php echo form_label('Carrera','carrera') ?>
        <?php echo form_input($carrera1) ?>
    </div>
    <div class="form-group">
        <?php echo form_label('Facultad','facultad') ?>
        <?php echo form_dropdown('facultad',$options,isset($carrera)?$carrera['facultad_id']:'','class="form-control"') ?>
    </div>
    <div>
        <input type="submit" value="<?php echo $title ?>" class="btn btn-success">
    </div>
<?php echo form_close() ?>