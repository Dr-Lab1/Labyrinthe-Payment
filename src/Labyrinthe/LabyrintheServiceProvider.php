<?php

namespace Labyrinthe\Payment\Labyrinthe;

use Labyrinthe\Payment\Labyrinthe\Handler\Labyrinthe;

class LabyrintheServiceProvider
{

    /**
     * The static 'betaMobile' method is the one that facilitates rapid 
     * integration of the payment module into your application.
     * 
     * It receives an array as a parameter with data such as: 
     * merchant, type, reference, amount, currency, callbackUrl, phone, token, gateway, etc. 
     * 
     * @param array $request
     * 
     * @return mixed
     */
    public static function betaMobile(array $array, array $options = [])
    {
        $mobile = new Labyrinthe();
        return $mobile->betaMobile($array, $options);
    }
    
    /**
     * The 'checkTransaction' method is the one that facilitates rapid 
     * checking of the payment state
     * 
     * It receives an array as a parameter with data such as: 
     * orderNumber, token, gateway
     * 
     * @param array $array
     * 
     * @return mixed
     */
    public static function checkTransaction(array $array, array $options = [])
    {
        $mobile = new Labyrinthe();
        return $mobile->checkTransaction($array, $options);
    }
}
