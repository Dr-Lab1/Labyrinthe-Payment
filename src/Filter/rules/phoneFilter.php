<?php

namespace Labyrinthe\Payment\Filter\Rules;

use Labyrinthe\Payment\Filter\Rules\CountriesCodeList;

trait PhoneFilter
{
    # Traits
    use CountriesCodeList;

    /**
     * This function is used to check and filter whether the user's specific telephone number data conforms to the rules.
     * It returns a string 
     * 
     * @param string $phone
     * @param string $isoCode
     * 
     * @return string
     */

    public function phoneNumberFilter(string $phone, string $isoCode): string
    {

        $prefix = substr($phone, 0, 1);

        if ($prefix == 0) {

            $phone = $this->countries[$isoCode] . substr($phone, 1);

        } else {

            $phone = $this->countries[$isoCode] . $phone;
            
        }

        return $phone;
    }
}
