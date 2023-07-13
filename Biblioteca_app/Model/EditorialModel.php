<?php 
namespace Model;
require_once(__DIR__.'../../vendor/autoload.php'); 
use PDO,PDOException;

class EditorialModel{

    public function GetAllEditorial($token) {
        $curl = curl_init();
        $url = 'http://127.0.0.1:8000/api/editorial/';
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

    
    public function AddEditorial($id,$editorial,$token) {
        $curl = curl_init();
        $url = 'http://127.0.0.1:8000/api/editorial/';
        $data = array(
            'id' => $id,
            'editorial' => $editorial,
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

    public function UpdateEditorial($id,$editorial,$token){
        $url = 'http://127.0.0.1:8000/api/editorial/'.$id.'/';
        $curl = curl_init($url);
        $data = array(
            'id' => $id,
            'editorial' => $editorial,
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

    public function DeleteEditorial($token,$id) {
        $curl = curl_init();
        $url = 'http://127.0.0.1:8000/api/editorial/'.$id.'/';
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