<?php
namespace Controller;
require_once(__DIR__.'../../../vendor/autoload.php'); 
require_once("./index.php");
use PDOException;
use Core\Core;
use Model\UsuarioModel;
try{
    if(!is_null($_POST['documento']) && !is_null($_POST['nombre']) && !is_null($_POST['apellido'])
    && !is_null($_POST['correo']) && !is_null($_POST['telefono']) && !is_null($_POST['password']) 
    && !is_null($_POST['cargo']) && !is_null($_POST['token'])){
        $documento = $_POST['documento'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $password = $_POST['password'];
        $cargo = $_POST['cargo'];
        $token = $_POST['token'];
        $response = UsuarioModel::UpdateUsuarios($documento,$nombre,$apellido,$email,$telefono,$password,$cargo,$token);
        if($response){
            Core::alert('Correcto','Se ha actualizado el usuario correctamente','./usuarios');
        }else{
            Core::alert('Error','No se actualizado el usuario','./usuarios');
        }
    }else{
        Core::alert('Error','Error de validacion','./usuarios');
    }
}catch(PDOException $ex){
    Core::alert('Error ', $ex->getMessage(),'./usuarios');
}