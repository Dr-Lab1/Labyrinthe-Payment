<?php

namespace Labyrinthe\Payment\FlexPay;

use Labyrinthe\Payment\FlexPay\FlexPayTrait;
use Labyrinthe\Payment\paymentServiceProvider;

class FlexPay extends paymentServiceProvider
{

    use FlexPayFilter;

    public function payment($request)
    {

        $request->validate([
            'phone' => ['required', 'numeric'],
            'amount' => ['required'],
            'currency' => ['required'],
        ]);

        $phone = self::phoneNumberFilter($request->phone);

        $data = array(
            "merchant" => "BPS",
            "type" => 1,
            "phone" => $phone,
            "reference" => "reference",
            "amount" => $request->amount,
            "currency" => $request->currency,
            "callbackUrl" => "https://abcd.efgh.cd",
        );
        $data = json_encode($data);
        $gateway = "https://beta-backend.flexpay.cd/api/rest/v1/paymentService";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $gateway);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJcL2xvZ2luIiwicm9sZXMiOlsiTUVSQ0hBTlQiXSwiZXhwIjoxNzU1OTYyNzEyLCJzdWIiOiIwYzJkZDIxYTU4NjQxYzI1MzFhNTNhOWQ0OGE3YTI4MyJ9.9ptbfzFNbcjboXua4Pcr9IrjubaCIMX48eYORggDo4k"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $error_message = 'Une erreur lors du traitement de votre requête';
        } else {
            curl_close($ch);
            $jsonRes = json_decode($response);
            $code = $jsonRes->code;
            if ($code != "0") {
                $error_message = 'Impossible de traiter la demande, veuillez réessayer';
            } else {
                $message = $jsonRes->message;
                $orderNumber = $jsonRes->orderNumber;
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
        return;
    }
}
