<?php

namespace Labyrinthe\Payment\Filter\Rules;

trait CountriesCodeList {

    /**
     * The list of countries using our system
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