<?php 
namespace Model;
require_once(__DIR__.'../../vendor/autoload.php'); 
use PDO,PDOException;

class UsuarioModel{

    public static function login($username, $password) {
        $url_login = 'http://127.0.0.1:8000/api-token-auth/';
        $login_data = array(
            'username' => $username,
            'password' => $password
        );
        $login_json = json_encode($login_data);
        $options = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/json',
                'content' => $login_json
            )
        );
        $context = stream_context_create($options);
        $response = file_get_contents($url_login, false, $context);
        $response_data = json_decode($response, true);
        if (isset($response_data)) {
            return $response_data;
        }
    }

    public function GetAllUsuarios($token) {
        $curl = curl_init();
        $url = 'http://127.0.0.1:8000/api/usuario/';
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

    public function GetAllPersonas($token) {
        $curl = curl_init();
        $url = 'http://127.0.0.1:8000/api/usuario-empleado/';
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
    
    public function AddUsuarios($documento,$nombre,$apellido,$email,$telefono,$password,$cargo,$token) {
        $curl = curl_init();
        $url = 'http://127.0.0.1:8000/api/usuario/';
        $data = array(
            'documento' => $documento,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'telefono' => $telefono,
            'password' => $password,
            'cargo' => $cargo
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

    public function UpdateUsuarios($documento,$nombre,$apellido,$email,$telefono,$password,$cargo,$token){
        $url = 'http://127.0.0.1:8000/api/usuario/'.$documento.'/';
        $curl = curl_init($url);
        $data = array(
            'documento' => $documento,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'telefono' => $telefono,
            'password' => $password,
            'cargo' => $cargo
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

    public function DeleteUsuarios($token,$id) {
        $curl = curl_init();
        $url = 'http://127.0.0.1:8000/api/usuario/'.$id.'/';
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