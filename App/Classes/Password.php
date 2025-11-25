<?php 

namespace App\Classes;

class Password{

    public function hash($password){

         

        $options = [
            'const' => 11
        ];
        return password_hash($password, PASSWORD_DEFAULT, $options);
    }

    public function verificarPassword($password, $hash){
        if(password_verify($password, $hash)){
            return true;
        }
        return false;
    }

}