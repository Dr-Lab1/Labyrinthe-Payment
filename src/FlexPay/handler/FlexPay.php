<?php

namespace Labyrinthe\Payment\FlexPay\Handler;

use Labyrinthe\Payment\paymentServiceProvider;
use Labyrinthe\Payment\Validator\Validator;

class FlexPay extends paymentServiceProvider implements FlexPayInterface
{

    use FlexPayTrait;

    /**
     * The 'mobile' method is the one that facilitates rapid 
     * integration of the payment module into your application.
     * It receives an array as a parameter with data such as: 
     * merchant, type, reference, amount, currency, callbackUrl, phone, authorization, gateway, etc. 
     * 
     * @param array $request
     * 
     * @return mixed
     */

    public function mobile(array $request): mixed
    {

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
            $this->result["errors"] = $validator;

            return $this->result;
        }

        $this->setParams($request);

        $ch = curl_init();

        $this->setOptions();

        curl_setopt_array($ch, $this->options);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $this->setResult(false, [], 'Une erreur lors du traitement de votre requête', []);
        } else {
            curl_close($ch);
            $jsonRes = json_decode($response);
            $code = $jsonRes->code;

            if ($code != "0") {
                $this->setResult(false, [], 'Impossible de traiter la demande, veuillez réessayer', $jsonRes);
            } else {
                $this->setResult(true, [], 'Transaction envoyée avec succès. Veuillez valider le push message', $jsonRes);
            }
        }

        # Final return
        return $this->result;
    }

    /**
     * The 'phone_results' method is the one that facilitates rapid 
     * checking of the payment results sent by flexpay to your 
     * application route sent by your callbackUrl param.
     * 
     * It receives an array as a parameter with data such as: 
     * code, reference", provider_reference, orderNumber, amount,
     * amountCustomer, phone, currency, createdAt, channel
     * 
     * @param array $request
     * 
     * @return mixed
     */

    public function phone_results(array $request): mixed
    {
        $validator = Validator::make(
            $request,
            [
                "code" => ["required"],
                "reference" => ["required"],
                "provider_reference" => ["required"],
                "orderNumber" => ["required"],
                "amount" => ["required"],
                "amountCustomer" => ["required"],
                "phone" => ["required"],
                "currency" => ["required"],
                "createdAt" => ["required"],
                "channel" => ["required"],
            ]
        );

        if ($validator) {
            $this->result["errors"] = $validator;

            return $this->result;
        }


        if (!$request["code"]) {
            #Le paiement a reussi 
            $this->setResult(true, [], "Le paiement a reussi", $request);
        } else {
            #Le paiement a reussi 
            $this->setResult(false, [], "Le paiement a échoué", []);
        }

        return $this->result;
    }

    /**
     * The 'card_results' method is the one that facilitates rapid 
     * checking of the payment results sent by flexpay to your 
     * application route sent by your callbackUrl param.
     * 
     * It receives an array as a parameter with data such as: 
     * code, reference", provider_reference, orderNumber
     * 
     * @param array $request
     * 
     * @return mixed
     */

     public function card_results(array $request): mixed
     {
         $validator = Validator::make(
             $request,
             [
                 "code" => ["required"],
                 "reference" => ["required"],
                 "provider_reference" => ["required"],
                 "orderNumber" => ["required"],
             ]
         );
 
         if ($validator) {
             $this->result["errors"] = $validator;
 
             return $this->result;
         }
 
 
         if (!$request["code"]) {
             #Le paiement a reussi 
             $this->setResult(true, [], "Le paiement a reussi", $request);
         } else {
             #Le paiement a reussi 
             $this->setResult(false, [], "Le paiement a échoué", []);
         }
 
         return $this->result;
     }
}
