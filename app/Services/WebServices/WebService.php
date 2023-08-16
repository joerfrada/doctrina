<?php

namespace App\Services\WebServices;

class WebService {

    public function getToken() {
        $url = "https://catalogoservicioweb.policia.gov.co/sw/Token";
        $username = "USRSW.APPDOCTRINA";
        $password = "AppDoctrina2030*";
        $params = "scope=&grant_type=password&username=" . $username . "&password=" . $password;
        $headers = array('Content-Type: application/json', 'Content-Length: ' . strlen($params));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3 * 60000);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($response);

        return $result->access_token;
    }

    public function getLogin($token, $username, $password) {
        $url = "https://catalogoservicioweb.policia.gov.co/sw/api/DiversidadPonal/LoginOud";
        $params = "scope=&grant_type=password&Usuario=" . $username . "&Contrasena=" . $password;
        $headers = [];
        $headers[] = 'grant_type: password';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $headers[] = "Authorization: Bearer ". $token;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3 * 60000);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($response);

        return $result;
    }

    function getConsultarImagenFuncionario($token, $numeroDocumento) {
        $url = "https://catalogoservicioweb.policia.gov.co/sw/api/DiversidadPonal/ConsultarImagenFuncionario?_numeroDocumento=" . $numeroDocumento;
        $headers = [];
        $headers[] = 'Content-Type: application/json';
        $headers[] = "Authorization: Bearer " . $token;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3 * 60000);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        $res = json_decode($response);

        if (is_object($res)) {
           $result  = "../../assets/img/avatar.jpg";
        }
        else {
            $result = $res;
        }

        return $result;
    }
}