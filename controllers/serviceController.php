<?php

function addService($params, $token)
{
    if($params === null) {
        return;
    }
    if (validatorJWT($token) === null) {
        response("Token no valido");
        return;
    }
    $newService = new Service($_POST["tipo"], $_POST["precio"], $_POST["demora"]);
    $newService->save();
    response("Servicio agregado con éxito");

}

function getByServiceType($tipo, $token)
{
    $payload = validatorJWT($token);

    if ($payload === null) {
        response("Token no valido");
        return;
    }

    if ($payload->userType != "admin") {
        response("Solo los usuarios de tipo admin pueden ejecutar esta acción");
        return;
    }

    $serviceByType = Service::getByTipo($tipo);
    if ($serviceByType) {
        response($serviceByType);
        return;
    }
    response(Service::getAll());
}


