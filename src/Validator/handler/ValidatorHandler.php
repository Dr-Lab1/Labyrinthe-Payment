<?php

namespace Labyrinthe\Payment\Validator\Handler;

use Labyrinthe\Payment\Validator\Rules\rules;

class ValidatorHandler implements ValidatorHandlerInterface
{

    use rules;

    protected array $errors = [];

    /**
     * The static 'make' method lets us quickly check certain conditions for accepting data.
     *
     * The current conditions are: required, number, etc.
     * 
     * @param array $array 
     * 
     * @param array $rules
     * 
     * @return array|null
     */

    public function make(array $array, array $rules): array|null
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
}
