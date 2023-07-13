<?php
namespace Controller;
require_once(__DIR__.'../../vendor/autoload.php'); 
use PDOException;
use Core\Core;
use Model\UsuarioModel;
class UsuarioController{
    public static function GetAllUsuario($token){
        try{
            $response = UsuarioModel::GetAllUsuarios($token);
            if($response) {
                $data = json_decode($response, true);
                return $data;
            }else {
                return 'Error en la solicitud: ' . $response;
            }
        }catch(PDOException $ex){
            Core::alert('Error', $ex->getMessage(),'./usuarios');
        }
    }
    public static function GetAllPersona($token){
        try{
            $response = UsuarioModel::GetAllPersonas($token);
            if($response) {
                $data = json_decode($response, true);
                return $data;
            }else {
                return 'Error en la solicitud: ' . $response;
            }
        }catch(PDOException $ex){
            Core::alert('Error', $ex->getMessage(),'./usuarios');
        }
    }
}
