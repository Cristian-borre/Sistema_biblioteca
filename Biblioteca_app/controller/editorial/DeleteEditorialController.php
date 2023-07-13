<?php
namespace Controller;
require_once(__DIR__.'../../../vendor/autoload.php'); 
require_once("./index.php"); 
use PDOException;
use Core\Core;
use Model\EditorialModel;
try{
    if(!is_null($_GET['id']) && !is_null( $_GET['jwt'])){
        $id = $_GET['id'];
        $token = $_GET['jwt'];
        $response = EditorialModel::DeleteEditorial($token,$id);
        if($response){
            Core::alert('Correcto','Se ha actualizado el estado del editorial correctamente','./editorial');
        }else{
            Core::alert('Error','No se actualizó','./editorial');
        }
    }else{
        Core::alert('Error','Error de validacion','./editorial');
    }
}catch(PDOException $ex){
    Core::alert('Error ', $ex->getMessage(),'./editorial');
}