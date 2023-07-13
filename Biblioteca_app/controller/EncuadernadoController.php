<?php
namespace Controller;
require_once(__DIR__.'../../vendor/autoload.php'); 
use PDOException;
use Core\Core;
use Model\EncuadernadoModel;
class EncuadernadoController{
    public static function GetAllEncuadernado($token){
        try{
            $response = EncuadernadoModel::GetAllEncuadernado($token);
            if($response) {
                $data = json_decode($response, true);
                return $data;
            }else {
                return 'Error en la solicitud: ' . $response;
            }
        }catch(PDOException $ex){
            Core::alert('Error', $ex->getMessage(),'./encuadernado');
        }
    }
}
