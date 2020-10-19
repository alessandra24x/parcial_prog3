<?php

require_once './filemanager.php';

class User extends FileManager {
    public $email;
    public $userType;
    public $password;
    public static $path = "./data/usuarios.json";

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * @param mixed $userType
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * User constructor.
     * @param $email
     * @param $userType
     * @param $password
     */
    public function __construct($email, $userType, $password)
    {
        $this->email = $email;
        $this->userType = $userType;
        $this->password = $password;
    }

    public function __toString(){
        return $this->email.','.$this->userType.','.$this->password;
    }

    public function getAll() {
        return self::readJson(Self::$path);
    }

    public function save() {
        try {
            $userList = self::readJson(Self::$path);
            array_push($userList, $this);
            self::saveJson(Self::$path, $userList);
        } catch (Exception $e) {
        }
    }

    public static function getByEmail($email){
        try {
            $userList = self::readJson(Self::$path);
            foreach($userList as $user) {
                if($user->email == $email) {
                    return $user;
                }
            }
        } catch (Exception $e) {
        }
    }

    public static function getByEmailAndPassword($email, $password){
        $user= self::getByEmail($email);
        if($user != null) {
            if($user->password == $password) {
                return $user;
            }
        }
    }

    public static function isTypeValid($userType){
        if($userType == "user" || $userType == "admin") {
            return true;
        }
        return false;
    }
}