<?php

namespace Labyrinthe\Payment\Validator\Handler;

interface ValidatorHandlerInterface
{

    public function make(array $array, array $rules): array|null;
}
