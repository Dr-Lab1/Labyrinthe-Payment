<?php

namespace Labyrinthe\Payment\Validator;

// use Labyrinthe\Payment\Validator\Handler\ValidatorHandler;
use Labyrinthe\Payment\Validator\Handler\ValidatorHandler;
class Validator
{

    protected ValidatorHandler $instance;

    public static function make(array $array, array $rules)
    {
        $validator = new ValidatorHandler();
        $check = $validator->make($array, $rules);

        if ($check) {
            return $check;
        }
    }
}
