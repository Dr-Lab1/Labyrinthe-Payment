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
     * ------------------------------------------------------------------------------------------------------
     *      Params      |                   Descritption                        | Example       | Required   
     * ------------------------------------------------------------------------------------------------------
     *  authorization   | This is the Bearer token sent by Flexpay              | Bearer xxxxx  |    YES    
     * ------------------------------------------------------------------------------------------------------
     *  merchant        | The merchant code is the one provided by flexpay      | "Orange"      |    YES    
     * ------------------------------------------------------------------------------------------------------
     *  type            | This is the type of transaction you want to carry out.| 1             |    YES    
     *                  | In our case it's mobile. So the type will be "1".     |               |           
     * ------------------------------------------------------------------------------------------------------
     *  reference       | This is the transaction reference. In other words,    |               |           
     *                  | the data that will enable the transaction to be traced| xxxxxxxxxx    |    YES    
     *                  | on your side.                                         |               |           
     * ------------------------------------------------------------------------------------------------------
     *  phone           | The telephone number involved in the transaction      | 243896699032  |    YES    
     * ------------------------------------------------------------------------------------------------------
     *  amount          | The amount of the transaction                         | 100           |    YES    
     * ------------------------------------------------------------------------------------------------------
     *  currency        | This is the currency to be used in the transaction    | USD           |    YES    
     * ------------------------------------------------------------------------------------------------------
     *  callbackUrl     | This is the route by which the response (the final    | abcdef.com    |    YES    
     *                  | information about the transaction) will be returned.  |               |           
     * ------------------------------------------------------------------------------------------------------
     *  gateway         | This is the URL that flexpay gave you to carry out    | backend.flex  |    YES    
     *                  | these mobile transactions                             |               |           
     * ------------------------------------------------------------------------------------------------------
     * 
     * @return mixed
     * 
     * ----------------------------------------------------------------------------------------------------------------------------
     *      Params      |                   Descritption                        | Example          
     * ----------------------------------------------------------------------------------------------------------------------------
     *  success         | This is the status of the request. Returns 'true' if  | true  or 1
     *                  | everything works and 'false' if it fails.             | false or 0
     * ----------------------------------------------------------------------------------------------------------------------------
     *  message         | This is the message that accompanies the response to  | "Process failed"  
     *                  | give it greater meaning                               |  
     * ----------------------------------------------------------------------------------------------------------------------------
     *  data            | This is an array containing the set of data returned  | [code] => 0
     *                  | by the query                                          | [message] => Transaction envoyée avec succès.
     *                  |                                                       | [orderNumber] => sjXMRrf98ISP243896699032 
     * ----------------------------------------------------------------------------------------------------------------------------
     *  errors          | A table listing all the errors encountered in the     | [errors] => Could not resolve host: beta-backend
     *                  | request                                               |                        
     * ----------------------------------------------------------------------------------------------------------------------------
     * 
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
