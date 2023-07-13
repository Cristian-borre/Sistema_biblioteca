<?php 
namespace Model;
require_once(__DIR__.'../../vendor/autoload.php'); 
use PDO,PDOException;

class AutoresModel{

    public function GetAllAutores($token) {
        $curl = curl_init();
        $url = 'http://127.0.0.1:8000/api/autor/';
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

    
    public function AddAutores($id,$autor,$token) {
        $curl = curl_init();
        $url = 'http://127.0.0.1:8000/api/autor/';
        $data = array(
            'id' => $id,
            'autor' => $autor,
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

    public function UpdateAutores($id,$autor,$token){
        $url = 'http://127.0.0.1:8000/api/autor/'.$id.'/';
        $curl = curl_init($url);
        $data = array(
            'id' => $id,
            'autor' => $autor,
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

    public function DeleteAutores($token,$id) {
        $curl = curl_init();
        $url = 'http://127.0.0.1:8000/api/autor/'.$id.'/';
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