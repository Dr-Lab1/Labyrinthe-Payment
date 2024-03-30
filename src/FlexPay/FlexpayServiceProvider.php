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
     * @return mixed
     */
    public static function mobile(array $array)
    {
        $mobile = new FlexPay();
        return $mobile->mobile($array);
    }

    /**
     * The 'check_phone_results' method is the one that facilitates rapid 
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
    public static function check_phone_results(array $array)
    {
        $mobile = new FlexPay();
        return $mobile->check_phone_results($array);
    }

    /**
     * The 'check_card_results' method is the one that facilitates rapid 
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
    public static function check_card_results(array $array)
    {
        $mobile = new FlexPay();
        return $mobile->check_phone_results($array);
    }
}
