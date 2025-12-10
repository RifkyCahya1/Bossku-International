<?php

namespace App\Services;

use Gemini\Laravel\Facades\Gemini;


class GeminiService
{
    public function translateToEnglish($text)
    {
        if (!$text || trim($text) === "") {
            return "";
        }

        $prompt = "
        Translate to natural English, EXACTLY one sentence, no explanations, no alternatives:
        {$text}
        ";


        $response = Gemini::generativeModel(model: 'gemini-2.0-flash-lite')
            ->generateContent($prompt);

        return $response->text() ?? "";
    }
}
