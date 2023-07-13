<?php
namespace Controller;
require_once(__DIR__.'../../../vendor/autoload.php'); 
require_once("./index.php"); 
use PDOException;
use Core\Core;
use Model\PrestamoModel;
try{
    if(!is_null($_POST['id']) && !is_null($_POST['libro']) && !is_null( $_POST['persona']) 
    && !is_null($_POST['fecha']) && !is_null($_POST['estado']) && !is_null($_POST['token'])){
        $id = Core::Sanitizar($_POST['id']);
        $libro = Core::Sanitizar($_POST['libro']);
        $persona = Core::Sanitizar($_POST['persona']);
        $fecha = Core::Sanitizar($_POST['fecha']);
        $estado = Core::Sanitizar($_POST['estado']);
        $token = Core::Sanitizar($_POST['token']);
        $response = PrestamoModel::UpdatePrestamo($id,$libro,$persona,$fecha,$estado,$token);
        if($response){
            Core::alert('Correcto','Se ha actualizado el prestamo correctamente','./prestamos');
        }else{
            Core::alert('Error','No se actualizó','./prestamos');
        }
    }else{
        Core::alert('Error','Error de validacion','./prestamos');
    }
}catch(PDOException $ex){
    Core::alert('Error ', $ex->getMessage(),'./prestamos');
}