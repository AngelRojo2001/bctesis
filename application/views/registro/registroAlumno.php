<h1><?= $title ?></h1>

<?php echo validation_errors(); ?>

<?php echo form_open($form) ?>
    <div class="form-group">
        <?= form_label('Código','codigo',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10">
            <input type="text" name="codigo" id="codigo" value="<?= set_value('codigo','') ?>" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <?= form_label('Apellidos','apellidos',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10">
            <input type="text" name="apellidos" id="apellidos" value="<?= set_value('apellidos','') ?>" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <?= form_label('Nombre(s)','nombres',array('class'=>'col-xs-2')) ?>
        <div class="col-xs-10">
            <input type="text" name="nombres" id="nombres" value="<?= set_value('nombres','') ?>" class="form-control">
        </div>
    </div>
    <div>
        <input type="hidden" value="<?= $tesis_id ?>" name="tesis_id">
        <input type="submit" value="<?= $title ?>" class="btn btn-success">
    </div>
</form>