<?php

namespace Labyrinthe\Payment\Validator;

use Labyrinthe\Payment\Validator\Rules\rules;

class Validator
{

    use rules;

    protected array $errors = [];

    protected function make(array $array, array $rules)
    {
        foreach ($rules as $key => $value) {
            foreach ($rules[$key] as $item) {
                if ($this->$item($array, $key)) {
                    $this->errors[] = $this->$item($array, $key);
                }
            }
        }

        if ($this->errors) {
            return false;
        } else {
            return true;
        }
    }

    protected function errors()
    {
        return $this->errors;
    }
}
