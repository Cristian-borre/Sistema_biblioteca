<?php
namespace Controller;
require_once(__DIR__.'../../../vendor/autoload.php'); 
require_once("./index.php"); 
use PDOException;
use Core\Core;
use Model\PrestamoModel;
try{
    if(!is_null($_POST['libro']) && !is_null( $_POST['persona']) && !is_null($_POST['fecha'])
    && !is_null($_POST['estado'])  && !is_null($_POST['token'])  && !is_null($_POST['url'])){
        $libro = Core::Sanitizar($_POST['libro']);
        $persona = Core::Sanitizar($_POST['persona']);
        $fecha = Core::Sanitizar($_POST['fecha']);
        $estado = Core::Sanitizar($_POST['estado']);
        $url = Core::Sanitizar($_POST['url']);
        $token = Core::Sanitizar($_POST['token']);
        $response = PrestamoModel::AddPrestamo($libro,$persona,$fecha,$estado,$token);
        if($response){
            Core::alert('Correcto','Se ha guardado el prestamo correctamente',"$url");
        }else{
            Core::alert('Error','No se ha guardo el prestamo correctamente',"$url");
        }
    }else{
        Core::alert('Error','Error de validacion',"$url");
    }
}catch(PDOException $ex){
    Core::alert('Error ', $ex->getMessage(),"$url");
}