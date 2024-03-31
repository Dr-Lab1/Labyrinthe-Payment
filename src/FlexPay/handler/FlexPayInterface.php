<?php

namespace Labyrinthe\Payment\FlexPay\Handler;

interface FlexPayInterface
{

    public function mobile(array $array): mixed;

    public function phoneResults(array $array): mixed;

    public function cardResults(array $array): mixed;

    public function checkTransaction(array $array): mixed;

    public function merchantPayOutService(array $array): mixed;
}
