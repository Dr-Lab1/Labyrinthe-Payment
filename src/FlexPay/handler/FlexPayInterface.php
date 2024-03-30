<?php

namespace Labyrinthe\Payment\FlexPay\Handler;

interface FlexPayInterface
{

    public function mobile(array $array): mixed;

    public function check_phone_results(array $array): mixed;

    public function check_card_results(array $array): mixed;
}
