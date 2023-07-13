<?php
namespace Controller;
require_once(__DIR__.'../../../vendor/autoload.php'); 
require_once("./index.php"); 
use Core\Core;
use Model\EncuadernadoModel;
try{
    if(!is_null($_POST['id']) && !is_null( $_POST['encuadernado']) && !is_null( $_POST['token'])){   
        $id = Core::Sanitizar($_POST['id']);
        $encuadernado = Core::Sanitizar($_POST['encuadernado']);
        $token = Core::Sanitizar($_POST['token']);
        $response = EncuadernadoModel::UpdateEncuadernado($id,$encuadernado,$token);
        if($response){
            Core::alert('Correcto','Se ha actualizado el encuadernado correctamente','./encuadernado');
        }else{
            Core::alert('Error','No se actualizó','./encuadernado');
        }
    }else{
        Core::alert('Error','Error de validacion','./encuadernado');
    }
}catch(PDOException $ex){
    Core::alert('Error ', $ex->getMessage(),'./encuadernado');
}