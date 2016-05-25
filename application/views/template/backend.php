<div class="col-xs-2" id="menu">
    <a href="<?= site_url() ?>" class="btn btn-primary btn-block">MENÚ PRINCIPAL</a>
    <a href="<?= site_url('registro') ?>" class="btn btn-primary btn-block">REGISTROS</a>
    <a href="<?= site_url('busqueda') ?>" class="btn btn-primary btn-block">BÚSQUEDAS</a>
    <a href="<?= site_url('reporte') ?>" class="btn btn-primary btn-block">REPORTES</a>    
    <a href="<?= site_url('perfil') ?>" class="btn btn-primary btn-block">EDITAR PERFIL</a>
    <?php if ($this->session->userdata('categoria') == 'admin') { ?>
        <a href="<?= site_url('facultad') ?>" class="btn btn-primary btn-block">FACULTAD</a>
        <a href="<?= site_url('carrera') ?>" class="btn btn-primary btn-block">CARRERA</a>
        <a href="<?= site_url('modalidad') ?>" class="btn btn-primary btn-block">MODALIDAD</a>
        <a href="<?= site_url('usuario') ?>" class="btn btn-primary btn-block">USUARIOS</a>
        <a href="<?= site_url('backup') ?>" class="btn btn-primary btn-block">BACKUP</a>
    <?php } ?>
    <a href="<?= site_url('login/logout_ci') ?>" class="btn btn-primary btn-block">CERRAR SESIÓN</a>
</div>
<div class="col-xs-10">
