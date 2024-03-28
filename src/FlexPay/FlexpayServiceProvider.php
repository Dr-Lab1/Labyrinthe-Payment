<?php

namespace Labyrinthe\Payment\FlexPay;

use Labyrinthe\Payment\FlexPay\Handler\FlexPay;

class FlexpayServiceProvider
{

    public static function mobile(array $array)
    {
        $mobile = new FlexPay();
        return $mobile->mobile($array);
    }
}
