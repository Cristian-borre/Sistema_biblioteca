<?php 
namespace Model;
require_once(__DIR__.'../../vendor/autoload.php'); 
use PDO,PDOException;

class LibrosModel{

    public function GetAllLibros($token) {
        $curl = curl_init();
        $url = 'http://127.0.0.1:8000/api/libro/';
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',  
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Token ' . $token
            )
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($statusCode === 200) {
            return $response;
        } else {
            return $statusCode;
        }
        curl_close($curl);
    }

    public function GetAllLibro($token) {
        $curl = curl_init();
        $url = 'http://127.0.0.1:8000/api/libro-empleado/';
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',  
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Token ' . $token
            )
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($statusCode === 200) {
            return $response;
        } else {
            return $statusCode;
        }
        curl_close($curl);
    }
    
    public function AddLibros($titulo,$img,$autor,$categoria,$editorial,$encuadernado,$ejemplares,$token) {
        $curl = curl_init();
        $url = 'http://127.0.0.1:8000/api/libro/';
        $data = array(
            'titulo' => $titulo,
            'img' => $img,
            'autor_id' => $autor,
            'categoria_id' => $categoria,
            'editorial_id' => $editorial,
            'encuadernado_id' => $encuadernado,
            'ejemplares' => $ejemplares,
        );
        $data_json = json_encode($data);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Token ' . $token,
            ),
            CURLOPT_POSTFIELDS => $data_json,
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($statusCode === 200) {
            return $response;
        } else {
            return $statusCode;
        }
        curl_close($curl);
    }

    public function UpdateLibros($id,$titulo,$img,$autor,$categoria,$editorial,$encuadernado,$ejemplares,$token){
        $url = 'http://127.0.0.1:8000/api/libro/'.$id.'/';
        $curl = curl_init($url);
        $data = array(
            'titulo' => $titulo,
            'img' => $img,
            'autor_id' => $autor,
            'categoria_id' => $categoria,
            'editorial_id' => $editorial,
            'encuadernado_id' => $encuadernado,
            'ejemplares' => $ejemplares,
        );
        $data_json = json_encode($data);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Token ' . $token,
            ),
            CURLOPT_POSTFIELDS => $data_json,
        ));
        $response = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($statusCode === 200) {
            return $response;
        } else {
            return $statusCode;
        }
        curl_close($curl);
    }

    public function DeleteLibros($token,$id) {
        $curl = curl_init();
        $url = 'http://127.0.0.1:8000/api/libro/'.$id.'/';
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'DELETE',  
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Token ' . $token
            )
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($statusCode === 200) {
            return $response;
        } else {
            return $statusCode;
        }
        curl_close($curl);
    }
} 