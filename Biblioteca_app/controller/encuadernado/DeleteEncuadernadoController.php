<?php
namespace Controller;
require_once(__DIR__.'../../../vendor/autoload.php'); 
require_once("./index.php"); 
use PDOException;
use Core\Core;
use Model\EncuadernadoModel;
try{
    if(!is_null($_GET['id']) && !is_null( $_GET['jwt'])){
        $id = Core::Sanitizar($_GET['id']);
        $token = Core::Sanitizar($_GET['jwt']);
        $response = EncuadernadoModel::DeleteEncuadernado($token,$id);
        if($response){
            Core::alert('Correcto','Se ha actualizado el estado del encuadernado correctamente','./encuadernado');
        }else{
            Core::alert('Error','No se actualizó','./encuadernado');
        }
    }else{
        Core::alert('Error','Error de validacion','./encuadernado');
    }
}catch(PDOException $ex){
    Core::alert('Error ', $ex->getMessage(),'./encuadernado');
}