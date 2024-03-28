<?php

namespace Labyrinthe\Payment\Validator;

use Labyrinthe\Payment\Validator\Handler\ValidatorHandler;

class Validator
{

    protected ValidatorHandler $instance;

    /**
     * The static 'make' method lets us quickly check certain conditions for accepting data.
     *
     * The current conditions are: required, number, etc.
     * 
     * @param array $array 
     * 
     * @param array $rules
     * 
     * @return array
     */

    public static function make(array $array, array $rules): array
    {
        $validator = new ValidatorHandler();
        return $validator->make($array, $rules);
    }
}
