<canvas id="canvasGraficos" width="300" height="300"></canvas>
<script type="text/javascript">
var ctx = document.getElementById("canvasGraficos").getContext("2d");
var myBar;
<?php if ($graficos == 1) { ?>
    var data = lineas();
    myBar = new Chart(ctx).Bar(data, {responsive: true});
<?php } ?>
<?php if ($graficos == 2) { ?>
    var data = lineas();
    myBar = new Chart(ctx).Line(data, {responsive: true});
<?php } ?>
<?php if ($graficos == 3) { ?>
    var data = lineas();
    myBar = new Chart(ctx).Radar(data, {responsive: true});
<?php } ?>
<?php if ($graficos == 4) { ?>
    var data = radios();
    myBar = new Chart(ctx).Doughnut(data, {responsive: true});
<?php } ?>
<?php if ($graficos == 5) { ?>
    var data = radios();
    myBar = new Chart(ctx).Pie(data, {responsive: true});
<?php } ?>
<?php if ($graficos == 6) { ?>
    var data = radios();
    myBar = new Chart(ctx).PolarArea(data, {responsive: true});
<?php } ?>

function lineas() {
    var cantidad = <?= $registros->num_rows() ?>;
    var nombres = new Array(cantidad);
    var valores = new Array(cantidad);
    var i = 0;
    <?php foreach ($registros->result() as $registro) { ?>
        nombres[i] = "<?= $registro->facultad ?>";
        valores[i] = "<?= $registro->cantidad ?>";
        i++;
    <?php } ?>
    var data = {
        labels : nombres,
        datasets : [
            {
                fillColor : "rgba(151,187,205,0.5)",
                strokeColor : "rgba(151,187,205,0.8)",
                //highlightFill : "rgba(151,187,205,0.75)",
                //highlightStroke : "rgba(151,187,205,1)",
                data : valores
            }
        ]
    };
    return data;
}

function radios() {
    var data = [
        <?php foreach ($registros->result() as $registro) { ?>
            {
                value: <?= $registro->cantidad ?>,
                color: "rgba(<?= rand(0,200) ?>,<?= rand(0,200) ?>,<?= rand(0,200) ?>,0.8)",
                label: "<?= $registro->facultad ?>"
            },
        <?php } ?>
    ];
    return data;
}
</script>