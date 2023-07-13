<?php
require_once(__DIR__.'../../../vendor/autoload.php'); 
require_once("./index.php"); 
use Core\Core;
use Model\UsuarioModel;
try{
    if(isset($_GET['id']) && isset($_GET['jwt'])){
        $id = $_GET['id'];
        $token = $_GET['jwt'];
        $response = UsuarioModel::DeleteUsuarios($token,$id);
        if($response){
            Core::alert('Correcto','Se ha actualizado el estado del usuario correctamente','./usuarios');
        }else{
            Core::alert('Error','No se actualizó','./usuarios');
        }
    }else{
        Core::alert('Error','Error de validacion','./usuarios');
    }
}catch(PDOException $ex){
    Core::alert('Error ', $ex->getMessage(),'./usuarios');
}
?>