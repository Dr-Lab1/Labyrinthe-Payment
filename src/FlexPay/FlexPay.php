<?php

namespace Labyrinthe\Payment\FlexPay;

use Labyrinthe\Payment\paymentServiceProvider;

class FlexPay extends paymentServiceProvider
{

    use FlexPayTrait;
    public function mobile(array $request)
    {

        $resuslt = [
            "success" => 0,
            "message" => "Process failed",
            "data" => []
        ];

        $this->setParams($request);

        $this->phone = $this->phoneNumberFilter($this->phone, 'COD');

        echo $this->phone;

        return 0;

        $data = $this->encodedData();
        $this->gateway = "https://beta-backend.flexpay.cd/api/rest/v1/paymentService";

        $ch = curl_init();

        $this->setOptions();

        curl_setopt_array($ch, $this->options);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return $resuslt['message'] = 'Une erreur lors du traitement de votre requête';
        } else {
            curl_close($ch);
            $jsonRes = json_decode($response);
            $code = $jsonRes->code;
            
            if ($code != "0") {
                $resuslt['message'] = 'Impossible de traiter la demande, veuillez réessayer';
            } else {
                $resuslt["data"] = $jsonRes;
            }
        }

        $response = json_decode($response);
        $data = json_decode($data);
        if (!$response->code) {
            # Success
        } else {
            # Payment failed
        }

        # Final return
        return $resuslt;
    }
}
