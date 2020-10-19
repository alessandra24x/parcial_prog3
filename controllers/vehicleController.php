<?php

function addVehicle($params, $token) {
    if ($params === null) {
        response('there are no params');
        return;
    }
    if (validatorJWT($token) === null) {
        response("Token no valido");
        return;
    }
    $patenteYaExiste = Vehicle::getByPatente($_POST['patente']) !== null;
    if ($patenteYaExiste) {
        response('Ya se encuentra cargado un vehículo con esa patente');
        return;
    }
    $newVehicle = new Vehicle($_POST["marca"], $_POST["modelo"], $_POST["patente"], $_POST["precio"]);
    $newVehicle->save();
    response("Vechiculo agregado con éxito");
}

function getByPatente($patente, $token) {
//    if ($patente === null) {
//        response('there are no params');
//        return;
//    }
    if (validatorJWT($token) === null) {
        response("Token no valido");
        return;
    }
    $vehicleByPatente = Vehicle::getByPatente($patente);
    if ($vehicleByPatente) {
        response($vehicleByPatente);
        return;
    }
    response("No existe ". $patente);
}

function getByMarca($marca, $token) {
//    if ($marca === null) {
//        response('there are no params');
//        return;
//    }
    if (validatorJWT($token) === null) {
        response("Token no valido");
        return;
    }
    $vehicleByMarca = Vehicle::getByMarca($marca);
    if ($vehicleByMarca) {
        response($vehicleByMarca);
        return;
    }
    response("No existe ". $marca);
}

function getByModelo($modelo, $token) {
//    if ($modelo === null) {
//        response('there are no params');
//        return;
//    }
    if (validatorJWT($token) === null) {
        response("Token no valido");
        return;
    }
    $vehicleByModelo = Vehicle::getByModelo($modelo);
    if ($vehicleByModelo) {
        response($vehicleByModelo);
        return;
    }
    response("No existe ". $modelo);
}

