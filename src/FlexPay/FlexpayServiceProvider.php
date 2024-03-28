<?php

namespace Labyrinthe\Payment\FlexPay;

use Labyrinthe\Payment\FlexPay\Handler\FlexPay;

class FlexpayServiceProvider
{

    /**
     * The static 'mobile' method is the one that facilitates rapid 
     * integration of the payment module into your application.
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
}
