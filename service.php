<?php

require_once './filemanager.php';

class Service extends FileManager {
    public $id;
    public $tipo;
    public $precio;
    public $demora;
    public static $path = "./data/tiposServicio.json";

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
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

    /**
     * @return mixed
     */
    public function getDemora()
    {
        return $this->demora;
    }

    /**
     * @param mixed $demora
     */
    public function setDemora($demora)
    {
        $this->demora = $demora;
    }

    /**
     * Service constructor.
     * @param $id
     * @param $tipo
     * @param $precio
     * @param $demora
     */
    public function __construct($tipo, $precio, $demora)
    {
        $this->tipo = $tipo;
        $this->precio = $precio;
        $this->demora = $demora;
    }

    public static function autoId($list) {
        $id = 0;
        foreach ($list as $item) {
            if($item->id > $id) {
                $id = $item->id;
            }
        }
        return $id + 1;
    }

    public static function getAll() {
        try {
            return self::readJson(Self::$path);
        } catch (Exception $e) {
            response("no se pudo traer la información");
        }
    }

    public static function getByTipo($tipo) {
        $serviceList = self::readJson(Self::$path);
        foreach($serviceList as $service) {
            if($service->tipo === $tipo) {
                return $service;
            }
        }
    }


    public function save() {
        try {
            $serviceList = self::readJson(Self::$path);
            $this->id = Service::autoId($serviceList);
            array_push($serviceList, $this);
            self::saveJson(Self::$path, $serviceList);
        } catch (Exception $e) {
            response("no se pudo guardar el archivo");
        }
    }
}