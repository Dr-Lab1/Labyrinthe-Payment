<?php

namespace Labyrinthe\Payment\FlexPay;

trait FlexPayTrait
{
    /**
     * It's a param called #merchant
     * Your Flexpay merchant's code
     * 
     * @var string
     */
    protected string $merchant;

    /**
     * It's a param called #type
     * 
     * @var int
     */
    protected int $type;

    /**
     * It's a param called #reference
     * 
     * @var string
     */
    protected string $reference;

    /**
     * It's a param called #amount
     * 
     * @var float
     */
    protected float $amount;

    /**
     * It's a param called #currency
     * 
     * @var string
     */
    protected string $currency;

    /**
     * It's a param called #callbackUrl
     * 
     * @var string
     */
    protected string $callbackUrl;

    /**
     * It's a param called #phone
     * 
     * @var string
     */
    protected string $phone;

    /**
     * It's a param called #data
     * 
     * @var array
     */
    protected array $data;

    /**
     * It's a param called #gateway
     * 
     * @var string
     */
    protected string $gateway;

    /**
     * It's a param called #options
     * 
     * @var array
     */
    protected array $options;

    /**
     * It's a param called #authorization
     * 
     * @var string
     */
    protected string $authorization;


    /**
     * The setParam function is used to update the configuration parameters used to initiate a transmission
     * 
     * @return void
     */
    protected function setParams(array $array): void
    {
        $this->merchant = $array["merchant"];
        $this->type = $array["type"];
        $this->reference = $array["reference"];
        $this->amount = $array["amount"];
        $this->currency = $array["currency"];
        $this->callbackUrl = $array["callbackUrl"];
        $this->phone = $array["phone"];
        $this->authorization = $array["authorization"];

        $this->data = [
            "merchant" => $this->merchant,
            "type" => $this->type,
            "phone" => $this->phone,
            "reference" => $this->reference,
            "amount" => $this->amount,
            "currency" => $this->currency,
            "callbackUrl" => $this->callbackUrl,
            "authorization" => $this->authorization,
        ];
    }

    protected function encodedData() {
        return json_encode($this->data);
    }

    protected function decodeData(string $encodedData) {
        return json_decode($encodedData);
    }

    protected function setOptions() : void {
        $this->options = [
            CURLOPT_URL, $this->gateway,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => array("Content-Type: application/json", "Authorization: $this->authorization"),
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POSTFIELDS => $this->encodedData($this->data),
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CONNECTTIMEOUT => 300
        ];
    }
}