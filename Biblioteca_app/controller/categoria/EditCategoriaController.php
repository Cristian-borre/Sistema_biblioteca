<?php
require_once(__DIR__.'../../../vendor/autoload.php'); 
require_once("./index.php"); 
use Core\Core;
use Model\CategoriaModel;
try{
    if(!is_null($_POST['id']) && !is_null( $_POST['categoria']) && !is_null( $_POST['token'])){   
        $id = Core::Sanitizar($_POST['id']);
        $categoria = Core::Sanitizar($_POST['categoria']);
        $token = Core::Sanitizar($_POST['token']);
        $response = CategoriaModel::UpdateCategoria($id,$categoria,$token);
        if($response){
            Core::alert('Correcto','Se ha actualizado la categoria correctamente','./categoria');
        }else{
            Core::alert('Error','No se actualizó','./categoria');
        }
    }else{
        Core::alert('Error','Error de validacion','./categoria');
    }
}catch(PDOException $ex){
    Core::alert('Error ', $ex->getMessage(),'./categoria');
}