<?php

require_once './filemanager.php';

class Vehicle extends FileManager {
    public $marca;
    public $modelo;
    public $patente;
    public $precio;
    public static $path = "./data/vehiculos.json";

    /**
     * Vehicle constructor.
     * @param $marca
     * @param $modelo
     * @param $patente
     * @param $precio
     */
    public function __construct($marca, $modelo, $patente, $precio)
    {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->patente = $patente;
        $this->precio = $precio;
    }

    /**
     * @return mixed
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * @param mixed $marca
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    /**
     * @return mixed
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * @param mixed $modelo
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * @return mixed
     */
    public function getPatente()
    {
        return $this->patente;
    }

    /**
     * @param mixed $patente
     */
    public function setPatente($patente)
    {
        $this->patente = $patente;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getAll() {
        return self::readJson(Self::$path);
    }

    public function save() {
        try {
            $vehiclesList = self::readJson(Self::$path);
            array_push($vehiclesList, $this);
            self::saveJson(Self::$path, $vehiclesList);
        } catch (Exception $e) {
        }
    }

    public static function getByPatente($patente){
        $vehiclesList = self::readJson(Self::$path);
        foreach($vehiclesList as $vehicle) {
            if(mb_strtolower($vehicle->patente) === mb_strtolower($patente)) {
                return $vehicle;
            }
        }
    }

    public static function getByMarca($marca){
        $vehiclesList = self::readJson(Self::$path);
        foreach($vehiclesList as $vehicle) {
            if(mb_strtolower($vehicle->marca) === mb_strtolower($marca)) {
                return $vehicle;
            }
        }
    }

    public static function getByModelo($modelo){
        $vehiclesList = self::readJson(Self::$path);
        foreach($vehiclesList as $vehicle) {
            if(mb_strtolower($vehicle->$modelo) === mb_strtolower($modelo)) {
                return $vehicle;
            }
        }
    }


}