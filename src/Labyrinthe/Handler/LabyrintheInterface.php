<?php

namespace Labyrinthe\Payment\Labyrinthe\Handler;

interface LabyrintheInterface
{

    public function sandbox(array $array, array $options = []): mixed;

    public function mobile(array $array, array $options = []): mixed;

    public function phoneResults(array $array, array $options = []): mixed;

    public function cardResults(array $array, array $options = []): mixed;

    public function getTransaction(array $array, array $options = []): mixed;

    public function getTransactions(array $array, array $options = []): mixed;

    public function merchantPayOutService(array $array, array $options = []): mixed;
    
}
