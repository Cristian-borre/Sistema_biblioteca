<?php
require_once(__DIR__.'../../../vendor/autoload.php'); 
require_once("./index.php"); 
use Core\Core;
use Model\PrestamoModel;
try{
    if(isset($_GET['id']) && isset($_GET['token'])){
        $id = Core::Sanitizar($_GET['id']);
        $token = Core::Sanitizar($_GET['token']);
        $response = PrestamoModel::UpdateEstadoPrestamo($token,$id);
        if($response){
            Core::alert('Correcto','Se ha actualizado el estado del prestamo correctamente','./prestamos2');
        }else{
            Core::alert('Error','No se actualizó','./prestamos2');
        }
    }else{
        Core::alert('Error','Error de validacion','./prestamos2');
    }
}catch(PDOException $ex){
    Core::alert('Error ', $ex->getMessage(),'./prestamos2');
}
?>