<?php

namespace app\components;

class CentrifugoHelper
{
    public static function send($info)
    {
        $jsonBody = json_encode([
            'method' => 'publish',
            'params' => [
                'channel' => 'public',
                'data' => $info
            ]
        ]);

        $url = 'http://92.63.103.157:9002/api';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: apikey bbd1bcad-ea12-40f7-8902-75d6aab484db'
        ]);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        $error = curl_error($ch);
        $headers = curl_getinfo($ch);
        curl_close($ch);

        if (empty($headers["http_code"]) || ($headers["http_code"] != 200)) {
            \Yii::error("Response code: "
                . $headers["http_code"]
                . PHP_EOL
                . "cURL error: " . $error . PHP_EOL);
        }
        return $data;
    }
}