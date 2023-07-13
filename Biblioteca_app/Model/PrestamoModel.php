<?php 
namespace Model;
require_once(__DIR__.'../../vendor/autoload.php'); 
use PDO,PDOException;

class PrestamoModel{

    public function GetAllPrestamo($token) {
        $curl = curl_init();
        $url = 'http://127.0.0.1:8000/api/prestamo/';
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

    
    public function AddPrestamo($libro,$persona,$fecha,$estado,$token) {
        $curl = curl_init();
        $url = 'http://127.0.0.1:8000/api/prestamo/';
        $data = array(
            'libro_id' => $libro,
            'persona_id' => $persona,
            'fecha_prestamo' => $fecha,
            'estado_prestamo' => $estado,
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

    public function UpdatePrestamo($id,$libro,$persona,$fecha,$estado,$token){
        $url = 'http://127.0.0.1:8000/api/prestamo/'.$id.'/';
        $curl = curl_init($url);
        $data = array(
            'libro_id' => $libro,
            'persona_id' => $persona,
            'fecha_prestamo' => $fecha,
            'estado_prestamo' => $estado,
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

    public function UpdateEstadoPrestamo($token,$id) {
        $curl = curl_init();
        $url = 'http://127.0.0.1:8000/api/prestamo/'.$id.'/';
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'PATCH',
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