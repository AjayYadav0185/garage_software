<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;
use Illuminate\Support\Facades\Auth;

class PhoneNumber implements Rule
{
    protected ?string $country;

    public function __construct(?string $country = null)
    {
        $this->country = $country ?? (Auth::check() && isset(Auth::user()->country)
            ? Auth::user()->country->code
            : 'IN');
    }

    public function passes($attribute, $value)
    {
        // Keep digits only
        $digits = preg_replace('/\D/', '', $value);

        // TEMP country-based length rules
        $lengthByCountry = [
            'IN' => 10,
            'AE' => 8,
        ];

        if (isset($lengthByCountry[$this->country])) {
            if (strlen($digits) !== $lengthByCountry[$this->country]) {
                return false;
            }
        }

        return true; 
    }


    // public function passes($attribute, $value)
    // {
    //     $phoneUtil = PhoneNumberUtil::getInstance();

    //     try {
    //         $numberProto = $phoneUtil->parse($value, $this->country);
    //         return $phoneUtil->isValidNumberForRegion($numberProto, $this->country);
    //     } catch (NumberParseException $e) {
    //         return false;
    //     }
    // }

    public function message()
    {
        return 'Invalid phone number.';
        // return 'The :attribute is not a valid phone number for your country.';
    }
}
