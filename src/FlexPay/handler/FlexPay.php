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

    public function mobile(array $request, array $options = []): mixed
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

        $json = isset($options['JSON']) ? $options['JSON'] : true;

        if ($validator) {
            $this->result["errors"] = $validator;

            if ($json)
                return $this->parseToJSON($this->result);

            return $this->result;
        }

        $this->setParams($request);


        $ch = curl_init();

        $this->setOptions("POST");

        curl_setopt_array($ch, $this->options);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $this->setResult(false, 'Une erreur lors du traitement de votre requête  ou vérifier votre connexion', $json, [], curl_error($ch));
        } else {
            curl_close($ch);
            $jsonRes = json_decode($response);
            $code = $jsonRes->code;

            if ($code != "0") {
                $this->setResult(false, 'Impossible de traiter la demande, veuillez réessayer', $json, $jsonRes);
            } else {
                $this->setResult(true, "Transaction envoyée avec succès. Veuillez valider le push message", $json, $jsonRes);
            }
        }

        $this->history(
            [
                "provider" => "flexpay",
                "method" => "mobile-payment",
                "amount" => $this->amount,
                "currency" => $this->currency
            ]
        );

        # Final return
        return $this->result;
    }

    /**
     * The 'phoneResults' method is the one that facilitates rapid 
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

    public function phoneResults(array $request, array $options = []): mixed
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

        $json = isset($options['JSON']) ? $options['JSON'] : true;

        if ($validator) {
            $this->result["errors"] = $validator;

            if ($json)
                return $this->parseToJSON($this->result);

            return $this->result;
        }

        if (!$request["code"]) {
            #Le paiement a reussi 
            $this->setResult(true, "Le paiement a reussi", $json,  $request);
        } else {
            #Le paiement a échoué 
            $this->setResult(false, "Le paiement a échoué", $json);
        }

        $this->history(
            [
                "provider" => "flexpay",
                "method" => "check-results"
            ]
        );

        return $this->result;
    }

    /**
     * The 'cardResults' method is the one that facilitates rapid 
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

    public function cardResults(array $request, array $options = []): mixed
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

        $json = isset($options['JSON']) ? $options['JSON'] : true;

        if ($validator) {
            $this->result["errors"] = $validator;

            if ($json)
                return $this->parseToJSON($this->result);

            return $this->result;
        }

        if (!$request["code"]) {
            #Le paiement a reussi 
            $this->setResult(true, "Le paiement a reussi", $json,  $request);
        } else {
            #Le paiement a échoué 
            $this->setResult(false, "Le paiement a échoué", $json);
        }

        $this->history(
            [
                "provider" => "flexpay",
                "method" => "check-results"
            ]
        );

        return $this->result;
    }

    /**
     * The 'checkTransaction' method is the one that facilitates rapid 
     * checking of the payment state
     * 
     * It receives an array as a parameter with data such as: 
     * orderNumber, authorization, gateway
     * 
     * @param array $array
     * 
     * @return mixed
     */
    public function checkTransaction(array $request, array $options = []): mixed
    {
        $validator = Validator::make(
            $request,
            [
                "authorization" => ["required"],
                "gateway" => ["required"],
                "orderNumber" => ["required"],
            ]
        );

        $json = isset($options['JSON']) ? $options['JSON'] : true;

        if ($validator) {
            $this->result["errors"] = $validator;

            if ($json)
                return $this->parseToJSON($this->result);

            return $this->result;
        }

        $this->setParams($request);

        $ch = curl_init();

        $this->setOptions("GET");

        curl_setopt_array($ch, $this->options);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $this->setResult(false, 'Une erreur lors du traitement de votre requête', $json, [], curl_error($ch));
        } else {
            curl_close($ch);
            $jsonRes = json_decode($response);
            $code = $jsonRes->code;

            switch ($code) {
                case '0':
                    $this->setResult(true, $jsonRes->message, $json, $jsonRes);
                    break;
                case '1':
                    $this->setResult(false, $jsonRes->message, $json, $jsonRes);
                    break;
            }
        }

        $this->history(
            [
                "provider" => "flexpay",
                "method" => "check-transaction",
            ]
        );

        # Final return
        return $this->result;
    }

    /**
     * The 'merchantPayOutService' method is the one that facilitates rapid 
     * integration of the payment module into your application.
     * It receives an array as a parameter with data such as: 
     * merchant, type, reference, amount, currency, callbackUrl, phone, authorization, gateway, etc. 
     * 
     * @param array $request
     * 
     * @return mixed
     */

    public function merchantPayOutService(array $request, array $options = []): mixed
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

        $json = isset($options['JSON']) ? $options['JSON'] : true;

        if ($validator) {
            $this->result["errors"] = $validator;

            if ($json)
                return $this->parseToJSON($this->result);

            return $this->result;
        }

        $this->setParams($request);

        $ch = curl_init();

        $this->setOptions("POST");

        curl_setopt_array($ch, $this->options);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $this->setResult(false, 'Une erreur lors du traitement de votre requête', $json, [], curl_error($ch));
        } else {
            curl_close($ch);
            $jsonRes = json_decode($response);
            $code = $jsonRes->code;

            if ($code != "0") {
                $this->setResult(false, 'Impossible de traiter la demande, veuillez réessayer', $json, $jsonRes);
            } else {
                $this->setResult(true, "Transaction envoyée avec succès. Veuillez valider le push message", $json, $jsonRes);
            }
        }

        $this->history(
            [
                "provider" => "flexpay",
                "method" => "pay-out",
            ]
        );

        # Final return
        return $this->result;
    }
}
