<?php

namespace Labyrinthe\Payment\Filter;

use Labyrinthe\Payment\Filter\countriesCodeList;

class phoneFilter
{
    # Traits
    use countriesCodeList;


    /**
     * The number the user will use to pay
     * 
     * @var string
     */

    protected $phone = null;


    /**
     * The isocode of the country where the payment is made
     * 
     * @var string
     */
    protected $isoCode = null;

    public function phoneNumberFilter(string $phone, string $isoCode): string
    {

        $this->phone = $phone;
        $this->isoCode = $isoCode;

        $prefix = substr($phone, 0, 1);

        if ($prefix == 0) {

            $phone = $this->countries[$this->isoCode] . substr($this->phone, 1);

        } else {

            $phone = $this->countries[$this->isoCode] . $this->phone;
            
        }

        return $phone;
    }
}
