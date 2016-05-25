<script type="text/javascript">
$(function() {
    $('#form_facultad').validate({
        rules: {
            facultad: {
                required: true
            }
        }
    });
});
</script>

<?php
$facultad = array(
    'name' => 'facultad',
    'class' => 'form-control',
    'value' => isset($facultad)?$facultad['facultad']:'',
    'placeholder' => 'Escriba la Facultad'
);
$form_facultad = array('id' => 'form_facultad');
?>

<h1><?php echo $title ?></h1>

<?php echo validation_errors() ?>
<?php echo form_open($form, $form_facultad) ?>
    <div class="form-group">
        <?php echo form_label('Facultad','facultad') ?>
        <?php echo form_input($facultad) ?>
    </div>
    <div>
        <input type="submit" value="<?php echo $title ?>" class="btn btn-success">
    </div>
<?php echo form_close() ?>