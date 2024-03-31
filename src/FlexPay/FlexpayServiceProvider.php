<?php

namespace Labyrinthe\Payment\FlexPay;

use Labyrinthe\Payment\FlexPay\Handler\FlexPay;

class FlexpayServiceProvider
{

    /**
     * The static 'mobile' method is the one that facilitates rapid 
     * integration of the payment module into your application.
     * 
     * It receives an array as a parameter with data such as: 
     * merchant, type, reference, amount, currency, callbackUrl, phone, authorization, gateway, etc. 
     * 
     * @param array $request
     * 
     * @return mixed
     */
    public static function mobile(array $array, array $options = [])
    {
        $mobile = new FlexPay();
        return $mobile->mobile($array, $options);
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
     * @param array $array
     * 
     * @return mixed
     */
    public static function phoneResults(array $array, array $options = [])
    {
        $mobile = new FlexPay();
        return $mobile->phoneResults($array, $options);
    }

    /**
     * The 'cardResults' method is the one that facilitates rapid 
     * checking of the payment results sent by flexpay to your 
     * application route sent by your callbackUrl param.
     * 
     * It receives an array as a parameter with data such as: 
     * code, reference", provider_reference, orderNumber
     * 
     * @param array $array
     * 
     * @return mixed
     */
    public static function cardResults(array $array, array $options = [])
    {
        $mobile = new FlexPay();
        return $mobile->cardResults($array, $options);
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
    public static function checkTransaction(array $array, array $options = [])
    {
        $mobile = new FlexPay();
        return $mobile->checkTransaction($array, $options);
    }

    /**
     * The static 'merchantPayOutService' method is the one that facilitates rapid 
     * integration of the payment module into your application.
     * 
     * It receives an array as a parameter with data such as: 
     * merchant, type, reference, amount, currency, callbackUrl, phone, authorization, gateway, etc. 
     * 
     * @param array $request
     * @return mixed
     */
    public static function merchantPayOutService(array $array, array $options = [])
    {
        $mobile = new FlexPay();
        return $mobile->merchantPayOutService($array, $options);
    }
}
