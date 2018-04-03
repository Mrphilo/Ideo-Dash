<?php
/**
 * Created by PhpStorm.
 * User: msds
 * Date: 22/03/2018
 * Time: 15:11
 */

namespace Ideo\DashBundle\Service;


class DoceboApi
{
    public function getAuthorization(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://elearning.ideo.ma/oauth2/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=client_credentials&client_id=doceboapi&client_secret=c7b3050a7df449556ea69daf49a71f3a5a9d560f",
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $access_array = json_decode($response,true);
        $access_token= $access_array['access_token'];
        $auth = "Authorization: Bearer ".$access_token;

        return $auth;
    }

    public function useDoceboApi($path_api,$postfields,$auth){

        $url = "http://elearning.ideo.ma/api".$path_api;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 180,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_HTTPHEADER => array(
                $auth,
            ),
        ));
        set_time_limit(0);
        $response = curl_exec($curl);
        curl_close($curl);
        $response_array = json_decode($response,true);

        return $response_array;
    }


}