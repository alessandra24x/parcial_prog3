<?php

class FileManager
{

    public static function guardarArchivo($fileName, $textoAEscribir)
    {
        $archivo = fopen($fileName, 'a');
        if ($archivo != null) {
            //file_put_contents($archivo, var_export($textoAEscribir, TRUE));
            fwrite($archivo, $textoAEscribir.PHP_EOL);
            fclose($archivo);
        } else {
            throw new Exception('El archivo no puede estar vacio.<br/>');
        }
    }

    public static function leerArchivo($fileName)
    {
        $array = array();
        if (file_exists($fileName)) {
            $archivo = fopen($fileName, 'r');
            $size = filesize($fileName);
            if ($size > 0) {
                while (!feof($archivo)) {
                    $content = fgets($archivo);
                    $data = explode(',', $content);
                    array_push($array, $data);
                }
            }
            fclose($archivo);
        }
        return $array;
    }

    public static function saveJson($fileName, $array)
    {
        $archivo = fopen($fileName, 'w');
        if ($archivo != null) {
            fwrite($archivo, json_encode($array, JSON_PRETTY_PRINT));
            fclose($archivo);
        } else {
            throw new Exception('El archivo no puede estar vacio.<br/>');
        }
    }

    public static function readJson($fileName)
    {
        $array = array();
        if (!file_exists($fileName)) {
            throw new Exception("El bendito archivo no existe, no tiene vida, it's gone");
        }
        $archivo = fopen($fileName, 'r');
        $size = filesize($fileName);
        $size > 0 ? $fread = fread($archivo, $size) : $fread = "{}";
        fclose($archivo);
        $array = json_decode($fread);
        return $array;
    }

    public static function guardarSerialize($fileName, $array)
    {
        $archivo = fopen($fileName, 'w');
        if ($archivo != null) {
            fwrite($archivo, serialize($array));
            fclose($archivo);
        } else {
            throw new Exception('El archivo no puede estar vacio.<br/>');
        }
    }

    public static function leerSerialize($fileName)
    {
        $array = array();
        if (file_exists($fileName)) {
            $archivo = fopen($fileName, 'r');
            $size = filesize($fileName);
            $size > 0 ? $fread = fread($archivo, $size) : $fread = "{}";
            // if($size > 0) {
            //     $fread = fread($archivo, $size);
            // } else {
            //     $fread = "{}";
            // }
            fclose($archivo);
            $array = unserialize($fread);
        }
        return $array;
    }
}