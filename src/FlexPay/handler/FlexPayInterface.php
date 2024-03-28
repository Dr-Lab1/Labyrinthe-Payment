<?php

namespace Labyrinthe\Payment\FlexPay\Handler;

interface FlexPayInterface {

    public function mobile (array $array) : mixed;

}