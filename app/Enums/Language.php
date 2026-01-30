<?php

namespace App\Enums;

enum Language: string
{
    case English = 'en';
    case Hindi = 'hi';
    case Assamese = 'as';
    case Bengali = 'bn';
    case Gujarati = 'gu';
    case Kannada = 'kn';
    case Malayalam = 'ml';
    case Marathi = 'mr';
    case Punjabi = 'pa';
    case Tamil = 'ta';
    case Telugu = 'te';
    case Urdu = 'ur';
    case Odia = 'or';
    case Nepali = 'ne';
    case Sanskrit = 'sa';
    case Sindhi = 'sd';
    case Santali = 'sat';
    case Konkani = 'kok';
    case Maithili = 'mai';
    case Manipuri = 'mni';
    case Bodo = 'brx';
    case Dogri = 'doi';
    case Kashmiri = 'ks';

    // European
    case French = 'fr';
    case Spanish = 'es';
    case German = 'de';
    case Italian = 'it';
    case Portuguese = 'pt';
    case Dutch = 'nl';
    case Russian = 'ru';
    case Ukrainian = 'uk';
    case Polish = 'pl';
    case Czech = 'cs';
    case Slovak = 'sk';
    case Romanian = 'ro';
    case Hungarian = 'hu';
    case Greek = 'el';
    case Swedish = 'sv';
    case Norwegian = 'no';
    case Danish = 'da';
    case Finnish = 'fi';

    // Asian
    case ChineseSimplified = 'zh-CN';
    case ChineseTraditional = 'zh-TW';
    case Japanese = 'ja';
    case Korean = 'ko';
    case Thai = 'th';
    case Vietnamese = 'vi';
    case Indonesian = 'id';
    case Malay = 'ms';
    case Filipino = 'tl';
    case Burmese = 'my';
    case Sinhala = 'si';

    // Middle East
    case Arabic = 'ar';
    case Hebrew = 'iw';
    case Persian = 'fa';
    case Turkish = 'tr';
    case Pashto = 'ps';
    case Kurdish = 'ku';

    // African
    case Swahili = 'sw';
    case Amharic = 'am';
    case Hausa = 'ha';
    case Yoruba = 'yo';
    case Zulu = 'zu';
    case Afrikaans = 'af';

    // Others
    case Esperanto = 'eo';
    case Latin = 'la';

    /**
     * Allowed languages per country
     */
    public static function allowedByCountry(string $countryCode): array
    {
        return match ($countryCode) {
            'IN' => [
                self::English,
                // self::Hindi,
                // self::Bengali,
                // self::Gujarati,
                // self::Kannada,
                // self::Malayalam,
                // self::Marathi,
                // self::Punjabi,
                // self::Tamil,
                // self::Telugu,
                // self::Urdu,
                // self::Odia,
                // self::Assamese,
                // self::Nepali,
                // self::Sindhi,
                // self::Konkani,
                // self::Maithili,
                // self::Manipuri,
                // self::Bodo,
                // self::Dogri,
                // self::Kashmiri,
                // self::Sanskrit,
                // self::Santali,
            ],

            'AE' => [
                self::English,
                self::Arabic,
                // self::Hindi,
                // self::Urdu,
                // self::Malay,
                // self::Bengali,
                // self::Punjabi,
                // self::Tamil,
                // self::Telugu,
                // self::Odia,
                // self::Kannada,
                // self::Marathi,
                // self::Gujarati,
                // self::Nepali,
            ],

            default => [
                self::English,
            ],
        };
    }

    /**
     * Friendly name for each language
     */
    public function label(): string
    {
        return match ($this) {
            self::English => 'English',
            self::Hindi => 'Hindi',
            self::Assamese => 'Assamese',
            self::Bengali => 'Bengali',
            self::Gujarati => 'Gujarati',
            self::Kannada => 'Kannada',
            self::Malayalam => 'Malayalam',
            self::Marathi => 'Marathi',
            self::Punjabi => 'Punjabi',
            self::Tamil => 'Tamil',
            self::Telugu => 'Telugu',
            self::Urdu => 'Urdu',
            self::Odia => 'Odia',
            self::Nepali => 'Nepali',
            self::Sanskrit => 'Sanskrit',
            self::Sindhi => 'Sindhi',
            self::Santali => 'Santali',
            self::Konkani => 'Konkani',
            self::Maithili => 'Maithili',
            self::Manipuri => 'Manipuri',
            self::Bodo => 'Bodo',
            self::Dogri => 'Dogri',
            self::Kashmiri => 'Kashmiri',
            self::French => 'French',
            self::Spanish => 'Spanish',
            self::German => 'German',
            self::Italian => 'Italian',
            self::Portuguese => 'Portuguese',
            self::Dutch => 'Dutch',
            self::Russian => 'Russian',
            self::Ukrainian => 'Ukrainian',
            self::Polish => 'Polish',
            self::Czech => 'Czech',
            self::Slovak => 'Slovak',
            self::Romanian => 'Romanian',
            self::Hungarian => 'Hungarian',
            self::Greek => 'Greek',
            self::Swedish => 'Swedish',
            self::Norwegian => 'Norwegian',
            self::Danish => 'Danish',
            self::Finnish => 'Finnish',
            self::ChineseSimplified => 'Chinese (Simplified)',
            self::ChineseTraditional => 'Chinese (Traditional)',
            self::Japanese => 'Japanese',
            self::Korean => 'Korean',
            self::Thai => 'Thai',
            self::Vietnamese => 'Vietnamese',
            self::Indonesian => 'Indonesian',
            self::Malay => 'Malay',
            self::Filipino => 'Filipino',
            self::Burmese => 'Burmese',
            self::Sinhala => 'Sinhala',
            self::Arabic => 'Arabic',
            self::Hebrew => 'Hebrew',
            self::Persian => 'Persian',
            self::Turkish => 'Turkish',
            self::Pashto => 'Pashto',
            self::Kurdish => 'Kurdish',
            self::Swahili => 'Swahili',
            self::Amharic => 'Amharic',
            self::Hausa => 'Hausa',
            self::Yoruba => 'Yoruba',
            self::Zulu => 'Zulu',
            self::Afrikaans => 'Afrikaans',
            self::Esperanto => 'Esperanto',
            self::Latin => 'Latin',
        };
    }
}
