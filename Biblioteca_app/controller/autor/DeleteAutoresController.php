<?php
require_once(__DIR__.'../../../vendor/autoload.php'); 
require_once("./index.php"); 
use Core\Core;
use Model\AutoresModel;
try{
    if(isset($_GET['id']) && isset($_GET['jwt'])){
        $id = $_GET['id'];
        $token = $_GET['jwt'];
        $response = AutoresModel::DeleteAutores($token,$id);
        if($response){
            Core::alert('Correcto','Se ha actualizado el estado del autor correctamente','./autores');
        }else{
            Core::alert('Error','No se actualizó','./autores');
        }
    }else{
        Core::alert('Error','Error de validacion','./autores');
    }
}catch(PDOException $ex){
    Core::alert('Error ', $ex->getMessage(),'./autores');
}
?>