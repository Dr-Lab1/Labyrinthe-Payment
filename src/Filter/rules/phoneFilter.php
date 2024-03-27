<?php

namespace Labyrinthe\Payment\Filter\Rules;

use Labyrinthe\Payment\Filter\Rules\countriesCodeList;

trait phoneFilter
{
    # Traits
    use countriesCodeList;

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
