<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AutoTranslateService
{
    public static function translate($text, $from = 'en', $to = 'fr')
    {
        $response = Http::post('https://translate.argosopentech.com/translate', [
            'q' => $text,
            'source' => $from,
            'target' => $to,
            'format' => 'text',
        ]);

        if ($response->successful()) {
            return $response->json()['translatedText'] ?? null;
        }

        return null;
    }
}
