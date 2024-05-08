<?php

namespace Labyrinthe\Payment\Labyrinthe\Handler;

use Labyrinthe\Payment\Filter\Filter;

trait LabyrintheTrait
{

    use Filter;

    /**
     * It's a param called #merchant
     * Your labyrinthe merchant's code
     * 
     * @var string
     */
    protected $merchant;

    /**
     * It's a param called #type
     * 
     * @var int
     */
    protected $type;

    /**
     * It's a param called #reference
     * 
     * @var string
     */
    protected $reference;

    /**
     * It's a param called #amount
     * 
     * @var float
     */
    protected $amount;

    /**
     * It's a param called #currency
     * 
     * @var string
     */
    protected $currency;

    /**
     * It's a param called #callbackUrl
     * 
     * @var string
     */
    protected $callbackUrl;

    /**
     * It's a param called #phone
     * 
     * @var string
     */
    protected $phone;

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
    protected $gateway;

    /**
     * It's a param called #options
     * 
     * @var array
     */
    protected array $options = [];

    /**
     * It's a param called #token
     * 
     * @var string
     */
    protected $token;


    /**
     * The setParam function is used to update the configuration parameters used to initiate a transmission
     * 
     * @return void
     */
    protected function setParams(array $array): void
    {
        $this->merchant = isset($array["merchant"]) ? $array["merchant"] : null;
        $this->type = isset($array["type"]) ? $array["type"] : null;
        $this->reference = isset($array["reference"]) ? $array["reference"] : null;
        $this->amount = isset($array["amount"]) ? $array["amount"] : null;
        $this->currency = isset($array["currency"]) ? $array["currency"] : null;
        $this->callbackUrl = isset($array["callbackUrl"]) ? $array["callbackUrl"] : null;
        $this->phone = isset($array["phone"]) ? $array["phone"] : null;
        $this->token = isset($array["token"]) ? $array["token"] : null;
        $this->orderNumber = isset($array["orderNumber"]) ? $array["orderNumber"] : null;
        $this->gateway = isset($array["gateway"]) ? $array["gateway"] : null;

        if ($this->merchant) {
            $this->data["merchant"] = $this->merchant;
        }

        if ($this->type) {
            $this->data["type"] = $this->type;
        }

        if ($this->phone) {
            $this->data["phone"] = $this->phone;
        }

        if ($this->reference) {
            $this->data["reference"] = $this->reference;
        }

        if ($this->amount) {
            $this->data["amount"] = $this->amount;
        }

        if ($this->currency) {
            $this->data["currency"] = $this->currency;
        }

        if ($this->callbackUrl) {
            $this->data["callbackUrl"] = $this->callbackUrl;
        }

        if ($this->token) {
            $this->data["token"] = $this->token;
        }

        if ($this->orderNumber) {
            $this->data["orderNumber"] = $this->orderNumber;
        }
    }

    protected function encodedData()
    {
        return json_encode($this->data);
    }

    protected function decodeData(string $encodedData)
    {
        return json_decode($encodedData);
    }

    protected function setOptions(string $method): void
    {
        switch ($method) {
            case 'POST':
                $this->options = [
                    CURLOPT_URL => $this->gateway,
                    CURLOPT_POST => true,
                    CURLOPT_HTTPHEADER => array("Content-Type: application/json", "token: $this->token"),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POSTFIELDS => $this->encodedData($this->data),
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_CONNECTTIMEOUT => 300
                ];
                break;

            case 'GET':
                $this->gateway = $this->gateway . '?' . http_build_query($this->data);
                $this->options = [
                    CURLOPT_URL => $this->gateway,
                    CURLOPT_HTTPHEADER => array("Content-Type: application/json", "token: $this->token"),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_CONNECTTIMEOUT => 300
                ];
                break;

            default:
                # code...
                break;
        }
    }
}
