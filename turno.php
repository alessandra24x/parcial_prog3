<?php

require_once './filemanager.php';

class turno extends FileManager
{

    public $fecha;
    public $patente;
    public $marca;
    public $modelo;
    public $precio;
    public $tipoServ;
    public static $path = "./data/turnos.json";

    /**
     * turno constructor.
     * @param $fecha
     * @param $patente
     * @param $marca
     * @param $modelo
     * @param $precio
     * @param $tipoServ
     */
    public function __construct($patente, $fecha, $marca, $modelo, $precio, $tipoServ)
    {
        $this->fecha = $fecha;
        $this->patente = $patente;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->precio = $precio;
        $this->tipoServ = $tipoServ;
    }

    public function getAll() {
        return self::readJson(Self::$path);
    }

    public function save() {
        try {
            $turnosList = self::readJson(Self::$path);
            array_push($turnosList, $this);
            self::saveJson(Self::$path, $turnosList);
        } catch (Exception $e) {
        }
    }
}