<?php
namespace Controller;
require_once(__DIR__.'../../vendor/autoload.php'); 
use PDOException;
use Core\Core;
use Model\PrestamoModel;
class PrestamosController{
    public static function GetAllPrestamos($token){
        try{
            $response = PrestamoModel::GetAllPrestamo($token);
            if($response){
                $data = json_decode($response,true);
                return $data;
            }else {
                return 'Error en la solicitud: ' . $response;
            }
        }catch(PDOException $ex){
            Core::alert('Error', $ex->getMessage(),'./prestamos');
        }
    }
}
