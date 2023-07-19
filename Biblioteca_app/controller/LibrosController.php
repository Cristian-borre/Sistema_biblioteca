<?php
namespace Controller;
require_once(__DIR__.'../../vendor/autoload.php'); 
use PDOException;
use Core\Core;
use Model\LibrosModel;
class LibrosController{
    public static function GetAllLibros($token){
        try{
            $response = LibrosModel::GetAllLibros($token);
            if($response){
                $data = json_decode($response,true);
                return $data;
            }else {
                return 'Error en la solicitud: ' . $response;
            }
        }catch(PDOException $ex){
            Core::alert('Error', $ex->getMessage(),'./libros');
        }
    }
    public static function GetAllLibro($token){
        try{
            $response = LibrosModel::GetAllLibro($token);
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
    public static function GetCountLibro($token){
        try{
            $response = LibrosModel::GetCountLibro($token);
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
