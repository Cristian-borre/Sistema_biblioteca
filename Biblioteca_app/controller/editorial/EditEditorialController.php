<?php
namespace Controller;
require_once(__DIR__.'../../../vendor/autoload.php'); 
require_once("./index.php"); 
use PDOException;
use Core\Core;
use Model\EditorialModel;
try{
    if(!is_null($_POST['id']) && !is_null( $_POST['editorial'])  && !is_null( $_POST['token'])){
        $id = Core::Sanitizar($_POST['id']);
        $editorial = Core::Sanitizar($_POST['editorial']);
        $token = Core::Sanitizar($_POST['token']);
        $response = EditorialModel::UpdateEditorial($id,$editorial,$token);
        if($response){
            Core::alert('Correcto','Se ha guardado el editorial correctamente','./editorial');
        }else{
            Core::alert('Error','No se ha guardo el editorial correctamente','./editorial');
        }
    }else{
        Core::alert('Error','Error de validacion','./editorial');
    }
}catch(PDOException $ex){
    Core::alert('Error ', $ex->getMessage(),'./editorial');
}