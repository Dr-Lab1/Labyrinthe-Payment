<?php

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


class phoneFilter
{

    use countriesCodeList;

    /**
     * The list of countries using our sts 
     * 
     * @var Array 
     */
    protected $phone = null;
    protected $isoCode = null;

    public function phoneNumberFilter(string $phone, string $isoCode): array
    {

        $this->phone = $phone;
        $this->isoCode = $isoCode;

        var_dump($this->countries);
        return $this->countries;

        // $prefix = substr($phone, 0, 1);

        // if ($prefix == 0) {
        //     $phone = "243" . substr($phone, 1);
        // } else {
        //     $phone = "243" . $phone;
        // }
        // return $phone;
    }
}

$phone = new phoneFilter();

return $phone->phoneNumberFilter("11111", "COD");
