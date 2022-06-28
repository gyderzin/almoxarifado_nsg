<?php

namespace App;

class Connection {
    
    public static function getDB($filial) {    
        try{
            $conexao = new \PDO (
                "mysql:host=localhost;dbname=almoxarifado_nsg_$filial;charset=utf8",
                'root', 
                '');    
            return $conexao;
        }
        catch(\PDOException $e) {
            // .....
        }

    }
}
   
?>