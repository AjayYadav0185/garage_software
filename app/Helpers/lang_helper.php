<?php

use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\NumberParseException;


if (!function_exists('translate')) {
    function translate(string $text): string
    {
        return $text;

        $lang = Auth::check()
            ? Auth::user()->lang ?? app()->getLocale()
            : app()->getLocale();

        // Skip translation for English
        if ($lang === 'en') {
            return $text;
        }

        // Cache key
        $cacheKey = "translation_{$lang}_" . md5($text);

        return Cache::rememberForever($cacheKey, function () use ($text, $lang) {
            static $translator;

            $translator ??= new GoogleTranslate();
            $translator->setTarget($lang);

            try {
                return $translator->translate($text);
            } catch (\Exception $e) {
                return $text;
            }
        });
    }
}

if (!function_exists('translateConcat')) {
    function translateConcat(string $text): string
    {
        // return $text;

        $lang = Auth::check()
            ? Auth::user()->lang ?? app()->getLocale()
            : app()->getLocale();

        // Skip translation for English
        $lang = 'ar';
        if ($lang === 'en') {
            return $text;
        }

        $cacheKey = "translation_{$lang}_" . md5($text);

        return Cache::rememberForever($cacheKey, function () use ($text, $lang) {
            static $translator;

            $translator ??= new GoogleTranslate();
            $translator->setTarget($lang);

            try {
                $translate = $translator->translate($text);
                return "{$translate} / {$text}";
            } catch (\Throwable $e) {
                return $text;
            }
        });
    }
}

if (!function_exists('currency')) {
    /**
     * Get the current currency code for the user/garage session, cached
     *
     * @return string
     */
    function currency(): string
    {
        $userId = Auth::id() ?? 0;
        $cacheKey = "user_currency_{$userId}";

        return Cache::rememberForever($cacheKey, function () use ($userId) {
            // Use session if available
            if (session()->has('currency')) {
                return session('currency');
            }

            // Use user's country currency if logged in
            if ($userId && Auth::check() && isset(Auth::user()->country)) {
                return Auth::user()->country->currency ?? 'AED';
            }

            return 'INR'; // default fallback
        });
    }
}

if (!function_exists('currency_symbol')) {
    /**
     * Get the currency symbol for the current currency, cached
     *
     * @return string
     */
    function currency_symbol(): string
    {
        $curr = currency();
        $cacheKey = "currency_symbol_{$curr}";

        return Cache::rememberForever($cacheKey, function () use ($curr) {
            $symbols = [
                'INR' => '₹',
                'AED' => 'د.إ',
                'USD' => '$',
                'EUR' => '€',
            ];

            return $symbols[$curr] ?? $curr;
        });
    }
}


if (!function_exists('format_currency')) {
    /**
     * Format amount with currency symbol, cached
     *
     * @param float $amount
     * @param bool $showSymbol
     * @return string
     */
    function format_currency(float $amount, bool $showSymbol = true): string
    {
        $formatted = number_format($amount, 2, '.', ',');
        return $showSymbol ? currency_symbol() . $formatted : $formatted;
    }
}


if (!function_exists('validate_phone')) {
    function validate_phone(string $phone, ?string $countryCode = null): bool
    {
        $countryCode ??= Auth::check() && isset(Auth::user()->country)
            ? Auth::user()->country->iso_code
            : 'IN';

        $phoneUtil = PhoneNumberUtil::getInstance();
        try {
            $numberProto = $phoneUtil->parse($phone, $countryCode);
            return $phoneUtil->isValidNumberForRegion($numberProto, $countryCode);
        } catch (NumberParseException $e) {
            return false;
        }
    }
}

if (!function_exists('format_phone')) {
    function format_phone(string $phone, ?string $countryCode = null): string
    {
        $countryCode ??= Auth::check() && isset(Auth::user()->country)
            ? Auth::user()->country->iso_code
            : 'IN';

        $phoneUtil = PhoneNumberUtil::getInstance();
        try {
            $numberProto = $phoneUtil->parse($phone, $countryCode);
            return $phoneUtil->format($numberProto, PhoneNumberFormat::INTERNATIONAL);
        } catch (NumberParseException $e) {
            return $phone;
        }
    }
}
