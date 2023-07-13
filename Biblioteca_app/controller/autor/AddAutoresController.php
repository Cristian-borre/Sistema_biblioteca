<?php
namespace Controller;
require_once(__DIR__.'../../../vendor/autoload.php'); 
require_once("./index.php"); 
use PDOException;
use Core\Core;
use Model\AutoresModel;
try{
    if(!is_null($_POST['id']) && !is_null( $_POST['autor']) && !is_null($_POST['token'])){
        $id = Core::Sanitizar($_POST['id']);
        $autor = Core::Sanitizar($_POST['autor']);
        $token = Core::Sanitizar($_POST['token']);
        $response = AutoresModel::AddAutores($id,$autor,$token);
        if($response){
            Core::alert('Correcto','Se ha guardado el autor correctamente','./autores');
        }else{
            Core::alert('Error','No se ha guardo el autor correctamente','./autores');
        }
    }else{
        Core::alert('Error','Error de validacion','./autores');
    }
}catch(PDOException $ex){
    Core::alert('Error ', $ex->getMessage(),'./autores');
}