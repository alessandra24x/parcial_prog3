<?php

require __DIR__ . '/vendor/autoload.php';
require('./user.php');
require('./controllers/userController.php');
require('./vehicle.php');
require('./controllers/vehicleController.php');
require('./service.php');
require('./controllers/serviceController.php');
require('./turno.php');
require('./controllers/turnoController.php');
require('./helper.php');

$method = $_SERVER['REQUEST_METHOD'] ?? '';
//$path_info = $_SERVER['PATH_INFO'] ?? '';
$path_info = explode('/', $_SERVER['PATH_INFO']) ?? '';
$token = $_SERVER['HTTP_TOKEN'] ?? '';

switch ($method) {
    case 'POST':
        switch ($path_info[1]) {
            case 'registro':
                createUser(["email", "userType", "password"]);
                break;
            case 'login':
                login(["email", "password"]);
                break;
            case 'vehiculo':
                addVehicle(["marca", "modelo", "patente", "precio"], $token);
                break;
            case 'servicio':
                addService(["tipo", "precio", "demora"], $token);
                break;
            case 'turno':
                addTurno(["patente", "fecha", "tipoServ"], $token);
                break;
        }
        break;
    case 'GET':
        switch ($path_info[1]) {
            case 'patente':
                getByPatente($path_info[2], $token);
                break;
            case 'stats':
                getByServiceType(["tipo"], $token);
                break;

        }
}