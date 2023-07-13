<?php 
namespace Controller;
require_once(__DIR__.'../../vendor/autoload.php'); 
use PDOException;
use Core\Core;
use Model\UsuarioModel;

try{
    if(!is_null( $_POST['usuario']) && !is_null( $_POST['password'])){  
        if((isset($_POST["usuario"]))&&(isset($_POST["password"]))){
            if((is_string($_POST["usuario"])) && (ctype_alnum($_POST["password"]))){ 
                $username = $_POST['usuario'];
                $password = $_POST['password'];
                $usuario = UsuarioModel::login($username, $password);
                if($usuario['Mensaje'] == "Usuario encontrado"){
                    if($usuario['Datos']['estado']){
                        session_start();
                        $_SESSION['cargo'] = $usuario['Datos']['cargo'];
                        $_SESSION['token'] = $usuario['Datos']['token'];
                        $_SESSION['user_id'] = $usuario['Datos']['user_id'];
                        if($_SESSION['cargo'] == 1){
                            Core::redir_log('./prestamos');
                        }else if($_SESSION['cargo'] == 2){
                            Core::redir_log('./prestamos2');
                        }else if($_SESSION['cargo'] == 3){
                            Core::redir_log('./libros3');
                        }
                    } else{
                        Core::redir("Usuario inactivo",'./login');
                    }    
                }else{
                    Core::redir("Usuario o contraseña incorrecta",'./login');
                }  
            }else{
                Core::redir("Campos invalidos",'./login');
            }          
        }else{
            Core::redir("Error de validacion",'./login');
        }  
    }else{
        Core::redir("No se pueden ingresar campos nulos",'./login');
    }  
}catch(PDOException $ex){
   Core::redir("Excepcion controlada",$ex->getMessage(),'./login');
}