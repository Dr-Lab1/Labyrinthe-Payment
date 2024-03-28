<?php

namespace Labyrinthe\Payment\Validator\Rules;

trait rules
{

    protected function required(array $array, string $key)
    {
        $valid = isset($array[$key]) ? true : false;

        if (!$valid) 
            return $key . " is required <br>";
        
    }

    // The type as a string. Can be one of the following values: "boolean", "integer", "double", "string", "array", "object", "resource", "NULL", "unknown type"
    protected function number(array $array, string $key)
    {
        $type = gettype($array[$key]);
        if (!($type == "boolean" || $type == "integer" || $type == "double")) {
            return $key . " is not a number <br>";
        }
        
    }
}
