<?php

namespace Labyrinthe\Payment\Labyrinthe\Handler;

use Labyrinthe\Payment\Labyrinthe\Handler\LabyrintheInterface;
use Labyrinthe\Payment\paymentServiceProvider;
use Labyrinthe\Payment\Validator\Validator;

class Labyrinthe extends paymentServiceProvider implements LabyrintheInterface
{

    use LabyrintheTrait;

    /**
     * The 'sandbox' method is the one that facilitates rapid 
     * integration of the payment module into your application.
     * It receives an array as a parameter with data such as: 
     * merchant, type, reference, amount, currency, callbackUrl, phone, token, gateway, etc. 
     * 
     * @param array $request
     * 
     * @return mixed
     */

    public function sandbox(array $request, array $options = []): mixed
    {

        $validator = Validator::make(
            $request,
            [
                "reference" => ['required'],
                "phone" => ["required"],
                "token" => ["required"],
                "gateway" => ["required"]
            ]
        );

        // return $request;

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

            if (!$jsonRes->success) {
                $this->setResult(false, 'Impossible de traiter la demande, veuillez réessayer', $json, $jsonRes, $jsonRes->errors);
            } else {
                $this->setResult(true, "Transaction envoyée avec succès. Veuillez valider le push message", $json, $jsonRes);
            }
        }

        $this->history(
            [
                "provider" => "labyrinthe",
                "method" => "mobile-payment",
                "amount" => "100",
                "currency" => "CDF"
            ]
        );

        # Final return
        return $this->result;
    }

    /**
     * The 'mobile' method is the one that facilitates rapid 
     * integration of the payment module into your application.
     * It receives an array as a parameter with data such as: 
     * merchant, type, reference, amount, currency, callbackUrl, phone, token, gateway, etc. 
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
                "token" => ["required"],
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

            if (!$jsonRes->success) {
                $this->setResult(false, 'Impossible de traiter la demande, veuillez réessayer', $json, $jsonRes);
            } else {
                $this->setResult(true, "Transaction envoyée avec succès. Veuillez valider le push message", $json, $jsonRes);
            }
        }

        $this->history(
            [
                "provider" => "labyrinthe",
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
     * checking of the payment results sent by labyrinthe to your 
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
                "provider" => "labyrinthe",
                "method" => "check-results"
            ]
        );

        return $this->result;
    }

    /**
     * The 'cardResults' method is the one that facilitates rapid 
     * checking of the payment results sent by labyrinthe to your 
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
                "provider" => "labyrinthe",
                "method" => "check-results"
            ]
        );

        return $this->result;
    }

    /**
     * The 'getTransaction' method is the one that facilitates rapid 
     * checking of the payment state
     * 
     * It receives an array as a parameter with data such as: 
     * orderNumber, token, gateway
     * 
     * @param array $array
     * 
     * @return mixed
     */
    public function getTransaction(array $request, array $options = []): mixed
    {
        $validator = Validator::make(
            $request,
            [
                "token" => ["required"],
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

        $this->setOptions("POST");

        curl_setopt_array($ch, $this->options);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $this->setResult(false, 'Une erreur lors du traitement de votre requête', $json, [], curl_error($ch));
        } else {
            curl_close($ch);
            $jsonRes = json_decode($response);
            
            if ($jsonRes->success) {
                $this->setResult(true, "La transaction demandée.", $json, $jsonRes);
            } else {
                $this->setResult(false, "Une erreur s'est produite.", $json, $jsonRes);
            }
        }

        $this->history(
            [
                "provider" => "labyrinthe",
                "method" => "check-transaction",
            ]
        );

        # Final return
        return $this->result;
    }

    /**
     * The 'getTransactions' method is the one that facilitates rapid 
     * checking of the payment state
     * 
     * It receives an array as a parameter with data such as: 
     * token, gateway
     * 
     * @param array $array
     * 
     * @return mixed
     */
    public function getTransactions(array $request, array $options = []): mixed
    {
        $validator = Validator::make(
            $request,
            [
                "token" => ["required"],
                "gateway" => ["required"],
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

            if ($jsonRes->success) {
                $this->setResult(true, "La liste de vos transactions.", $json, $jsonRes);
            } else {
                $this->setResult(false, "Une erreur s'est produite.", $json, $jsonRes);
            }
        }

        $this->history(
            [
                "provider" => "labyrinthe",
                "method" => "get-transactions",
            ]
        );

        # Final return
        return $this->result;
    }

    /**
     * The 'merchantPayOutService' method is the one that facilitates rapid 
     * integration of the payment module into your application.
     * It receives an array as a parameter with data such as: 
     * merchant, type, reference, amount, currency, callbackUrl, phone, token, gateway, etc. 
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
                "token" => ["required"],
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
                "provider" => "labyrinthe",
                "method" => "pay-out",
            ]
        );

        # Final return
        return $this->result;
    }
}
