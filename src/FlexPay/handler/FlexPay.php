<?php

namespace Labyrinthe\Payment\FlexPay\Handler;

use Labyrinthe\Payment\paymentServiceProvider;
use Labyrinthe\Payment\Validator\Validator;

class FlexPay extends paymentServiceProvider implements FlexPayInterface
{

    use FlexPayTrait;

    public function mobile(array $request): mixed
    {

        /**
         * Ceci est le format de réponse défini
         * 
         * @var array
         */
        $resuslt = [
            "success" => 0,
            "errors" => [],
            "message" => "Process failed",
            "data" => []
        ];

        $validator = Validator::make(
            $request,
            [
                "merchant" => ['required'],
                "type" => ["required", "number"],
                "reference" => ['required'],
                "amount" => ['required', "number"],
                "currency" => ["required"],
                "callbackUrl" => ["required"],
                "phone" => ["required"],
                "authorization" => ["required"],
                "gateway" => ["required"]
            ]
        );

        if ($validator) {
            $resuslt["errors"] = $validator;

            return $resuslt;
        }

        return [];

        $this->setParams($request);

        $ch = curl_init();

        $this->setOptions();

        curl_setopt_array($ch, $this->options);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {

            $resuslt['message'] = 'Une erreur lors du traitement de votre requête';
        } else {
            curl_close($ch);
            $jsonRes = json_decode($response);
            $code = $jsonRes->code;

            if ($code != "0") {
                $resuslt['message'] = 'Impossible de traiter la demande, veuillez réessayer';
                $resuslt['data'] = $jsonRes;
            } else {
                $resuslt["data"] = $jsonRes;
            }
        }

        # Final return
        return $resuslt;
    }
}
