<?php

foreach ($carreras as $carrera) {
	$opcCar[$carrera['id']] = $carrera['carrera'];
}


echo form_dropdown('carrera',$opcCar,'','id="carrera" class="form-control"');