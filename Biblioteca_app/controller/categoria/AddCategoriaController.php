<?php
namespace Controller;
require_once(__DIR__.'../../../vendor/autoload.php'); 
require_once("./index.php"); 
use PDOException;
use Core\Core;
use Model\CategoriaModel;
try{
    if(!is_null($_POST['id']) && !is_null( $_POST['categoria']) && !is_null($_POST['token'])){
        $id = Core::Sanitizar($_POST['id']);
        $categoria = Core::Sanitizar($_POST['categoria']);
        $token = Core::Sanitizar($_POST['token']);
        $response = CategoriaModel::AddCategoria($id,$categoria,$token);
        if($response){
            Core::alert('Correcto','Se ha guardado el categoria correctamente','./categoria');
        }else{
            Core::alert('Error','No se ha guardo el categoria correctamente','./categoria');
        }
    }else{
        Core::alert('Error','Error de validacion','./categoria');
    }
}catch(PDOException $ex){
    Core::alert('Error ', $ex->getMessage(),'./categoria');
}