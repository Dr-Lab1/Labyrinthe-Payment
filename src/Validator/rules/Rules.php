<?php

namespace Labyrinthe\Payment\Validator\Rules;

trait Rules
{

    /**
     * This function is used to check the existence of specific data.
     * It returns nothing if the data exists, but returns an error if the data is missing.
     * 
     * @param array $array
     * @param array $key
     * 
     * @return string|null
     * 
     */
    protected function required(array $array, string $key): string|null
    {
        $valid = isset($array[$key]) ? true : false;

        if (!$valid)
            return $key . " is required";
        else
            return null;
    }

    /**
     * This function is used to check whether the specific data sent is indeed of type number.
     * It returns nothing if the data exists, but returns an error if the data is not a number.
     * The type can be one of the following values: "boolean", "integer", "double"
     * 
     * @param array $array
     * 
     * @param string $key
     * 
     * @return string|null
     */

    protected function number(array $array, string $key): string|null
    {
        $type = isset($array[$key]) ? gettype($array[$key]) : null;

        if (!($type == "boolean" || $type == "integer" || $type == "double") || $type == null)
            return $key . " is not a number ";
        else
            return null;
    }
}
