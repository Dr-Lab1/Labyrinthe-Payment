<?php

namespace Labyrinthe\Payment\Labyrinthe;

use Labyrinthe\Payment\Labyrinthe\Handler\Labyrinthe;

class LabyrintheServiceProvider
{

    /**
     * The static 'sandbox' method is the one that facilitates rapid 
     * integration of the payment module into your application.
     * 
     * It receives an array as a parameter with data such as: 
     * merchant, type, reference, amount, currency, callbackUrl, phone, token, gateway, etc. 
     * 
     * @param array $request
     * 
     * @return mixed
     */
    public static function sandbox(array $array, array $options = [])
    {
        $labyrinthe = new Labyrinthe();
        return $labyrinthe->sandbox($array, $options);
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
    public static function getTransaction(array $array, array $options = [])
    {
        $labyrinthe = new Labyrinthe();
        return $labyrinthe->getTransaction($array, $options);
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
    public static function getTransactions(array $array, array $options = [])
    {
        $labyrinthe = new Labyrinthe();
        return $labyrinthe->getTransactions($array, $options);
    }
}
