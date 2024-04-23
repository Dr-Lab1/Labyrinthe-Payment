<?php

namespace Labyrinthe\Payment;

use Labyrinthe\Payment\Filter\Filter;

class kernel
{
    protected function history(array $array)
    {
        try {
            //code...
            $array = json_encode($array);
            $options = [
                CURLOPT_URL => "http://test-package.test/api/history",
                CURLOPT_POST => true,
                CURLOPT_HTTPHEADER => array("Content-Type: application/json"),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS => $array,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CONNECTTIMEOUT => 300
            ];

            $ch = curl_init();


            curl_setopt_array($ch, $options);
            $response = curl_exec($ch);

            if (curl_errno($ch)) {
            } else {
                curl_close($ch);
            }

            return $response;

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
