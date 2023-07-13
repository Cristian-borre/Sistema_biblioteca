<?php
require_once(__DIR__.'../../../vendor/autoload.php'); 
require_once("./index.php"); 
use Core\Core;
use Model\CategoriaModel;
try{
    if(isset($_GET['id']) && isset($_GET['jwt'])){
        $id = $_GET['id'];
        $token = $_GET['jwt'];
        $response = CategoriaModel::DeleteCategoria($token,$id);
        if($response){
            Core::alert('Correcto','Se ha actualizado el estado de la categoria correctamente','./categoria');
        }else{
            Core::alert('Error','No se actualizó','./categoria');
        }
    }else{
        Core::alert('Error','Error de validacion','./categoria');
    }
}catch(PDOException $ex){
    Core::alert('Error ', $ex->getMessage(),'./categoria');
}
?>