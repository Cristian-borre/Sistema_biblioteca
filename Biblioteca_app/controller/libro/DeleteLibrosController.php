<?php
namespace Controller;
require_once(__DIR__.'../../../vendor/autoload.php'); 
require_once("./index.php"); 
use PDOException;
use Core\Core;
use Model\LibrosModel;
try{
    if(!is_null($_GET['id']) && !is_null( $_GET['jwt'])){
        $id = Core::Sanitizar($_GET['id']);
        $token = Core::Sanitizar($_GET['jwt']);
        $response = LibrosModel::DeleteLibros($token,$id);
        if($response){
            Core::alert('Correcto','Se ha actualizado el estado del libro correctamente','./libros');
        }else{
            Core::alert('Error','No se actualizó','./libros');
        }
    }else{
        Core::alert('Error','Error de validacion','./libros');
    }
}catch(PDOException $ex){
    Core::alert('Error ', $ex->getMessage(),'./libros');
}