<?php
require_once(__DIR__.'../../../vendor/autoload.php'); 
require_once("./index.php"); 
use Core\Core;
use Model\LibrosModel;
try{
    if(!is_null($_POST['id']) && !is_null( $_POST['titulo']) && !is_null($_POST['token']) 
    && !is_null($_POST['autor']) && !is_null($_POST['categoria']) && !is_null($_POST['editorial']) 
    && !is_null($_POST['encuadernado']) && !is_null($_POST['ejemplares']) ){
        
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
            $id = Core::Sanitizar($_POST['id']);
            $titulo = Core::Sanitizar($_POST['titulo']);
            $img = $new_img_name;
            $autor = Core::Sanitizar($_POST['autor']);
            $categoria = Core::Sanitizar($_POST['categoria']);
            $editorial = Core::Sanitizar($_POST['editorial']);
            $encuadernado = Core::Sanitizar($_POST['encuadernado']);
            $ejemplares = Core::Sanitizar($_POST['ejemplares']);
            $token = Core::Sanitizar($_POST['token']);
            $response = LibrosModel::UpdateLibros($id,$titulo,$img,$autor,$categoria,$editorial,$encuadernado,$ejemplares,$token);
            if($response){
                Core::alert('Correcto','Se ha actualizado el libro correctamente','./libros');
            }else{
                Core::alert('Error','No se actualizó','./libros');
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