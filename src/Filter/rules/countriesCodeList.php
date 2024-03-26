<?php

namespace Labyrinthe\Payment\Filter;

trait countriesCodeList {

    /**
     * The list of countries using our sys
     * 
     * [isoCode => countryCode] 
     * 
     * @var Array 
     */
    
    protected array $countries = [
        "COD" => 243,
        "COG" => 242,
        "AGO" => 244
    ];


}