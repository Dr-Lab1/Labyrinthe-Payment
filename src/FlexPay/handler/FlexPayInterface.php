<?php

namespace Labyrinthe\Payment\FlexPay\Handler;

interface FlexPayInterface
{

    public function mobile(array $array): mixed;

    public function phone_results(array $array): mixed;

    public function card_results(array $array): mixed;
}
