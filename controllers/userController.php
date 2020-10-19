<?php

function createUser($params) {
    if($params != null) {
        if(User::isTypeValid($_POST["userType"])) {
            if(User::getByEmail($_POST["email"]) == null) {
                $newUser = new User($_POST["email"],$_POST["userType"],$_POST["password"]);
                $newUser->save();
                response("Usuario creado con èxito");
            } else {
                response("Ya existe un usuario con ese email");
            }
        } else
            response("El tipo de usuario debe ser user o admin");
    }
}

function login($params) {
    if($params != null) {
        $user = User::getByEmailAndPassword($_POST["email"],$_POST["password"]);
        if($user != null) {
            $payload = array("email" => $user->email, "userType" => $user->userType);
            $response = array("email" => $user->email, "userType" => $user->userType, "token" => createJWT($payload));
            response($response);
        } else {
            response("No coinciden los datos ingresados");
        }
    }
}