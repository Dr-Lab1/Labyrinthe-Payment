<?php

namespace Labyrinthe\Payment\Validator\Handler;

use Labyrinthe\Payment\Validator\Rules\rules;

class ValidatorHandler
{

    use rules;

    protected array $errors = [];

    public function make(array $array, array $rules)
    {
        foreach ($rules as $key => $value) {
            foreach ($rules[$key] as $item) {
                if ($this->$item($array, $key)) {
                    $this->errors[] = $this->$item($array, $key);
                }
            }
        }

        if ($this->errors)
            return $this->errors;
    }

    public function errors()
    {
        return $this->errors;
    }
}
