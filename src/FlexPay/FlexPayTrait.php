<?php

namespace Labyrinthe\Payment\FlexPay;

trait FlexPayFilter 
{

    private function phoneNumberFilter (string $phone) : string {

        $prefix = substr($phone, 0, 1);

        if ($prefix == 0) {
            $phone = "243" . substr($phone, 1);
        } else {
            $phone = "243" . $phone;
        }
        return $phone;
    }
    
}