<?php
namespace Controller;
require_once(__DIR__.'../../../vendor/autoload.php'); 
require_once("./index.php"); 
use PDOException;
use Core\Core;
use Model\LibrosModel;
try{
    if(isset($_POST['titulo']) && isset( $_POST['autor']) && isset($_POST['categoria']) 
    && isset($_POST['editorial']) && isset($_POST['encuadernado']) && isset($_POST['ejemplares'])
    && isset($_POST['token'])){

        if(isset($_FILES['img'])){
            $img_name = $_FILES['img']['name'];
            $tmp_name = $_FILES['img']['tmp_name'];

            $img_explode = explode('.',$img_name);
            $img_ext = end($img_explode);

            $allowed_exs = ["png","jpg","jpeg"];

            if(in_array($img_ext, $allowed_exs) === true){
                $new_img_name = $img_name;
                $img_upload_path = './upload/'.$new_img_name;
                move_uploaded_file($tmp_name,$img_upload_path); 
            }else{
                Core::alert('Error','No puedes usar este tipo de archivos','./libros');
            }
        }

        if(isset($new_img_name)){
            $titulo = Core::Sanitizar($_POST['titulo']);
            $img = $new_img_name;
            $autor = Core::Sanitizar($_POST['autor']);
            $categoria = Core::Sanitizar($_POST['categoria']);
            $editorial = Core::Sanitizar($_POST['editorial']);
            $encuadernado = Core::Sanitizar($_POST['encuadernado']);
            $ejemplares = Core::Sanitizar($_POST['ejemplares']);
            $token = Core::Sanitizar($_POST['token']);
            $response = LibrosModel::AddLibros($titulo,$img,$autor,$categoria,$editorial,$encuadernado,$ejemplares,$token);
            if($response){
                Core::alert('Correcto','Se ha guardado el libro correctamente','./libros');
            }else{
                Core::alert('Error','No se ha guardo el libro correctamente','./libros');
            }
        }else{
            Core::alert('Error','Ocurrio un error con la imagen','./libros');
        }
    }else{
        Core::alert('Error','Error de validacion','./libros');
    }
}catch(PDOException $ex){
    Core::alert('Error ', $ex->getMessage(),'./libros');
}