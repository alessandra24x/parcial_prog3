<?php

function addTurno($params, $token) {
    if($params === null) {
        return;
    }
    if (validatorJWT($token) === null) {
        response("Token no valido");
        return;
    }

    $getVehicle = Vehicle::getByPatente($_POST["patente"]);

    if($getVehicle === null) {
        response("Patente no encontrada. Verifique");
    }

    $newTurno = new Turno($_POST["patente"], $_POST["fecha"], $getVehicle->marca, $getVehicle->modelo,
    $getVehicle->precio, $_POST["tipoServ"]);
    $newTurno->save();
    response("Turno agregado con éxito");

}
