<?php

namespace Tschucki\TranslateJetstream\Translators\TranslateOperations;

use Closure;
use Tschucki\TranslateJetstream\Contracts\TranslateOperation;
use Tschucki\TranslateJetstream\Transporters\TranslationTransporter;

class TranslateElementPlaceholders implements TranslateOperation
{
    public function getPattern(): string
    {
        return '/(<[^>]+)(placeholder="([^"]*)")([^>]*>)/';
    }

    public function handle(TranslationTransporter $translationTransporter, Closure $next)
    {
        $fileContent = $translationTransporter->getFileContent();
        $translations = $translationTransporter->getTranslations();

        $fileContent = preg_replace_callback(
            $this->getPattern(),
            static function ($matches) use ($translations) {
                $element = $matches[1];
                $value = $matches[3];

                if (array_key_exists($value, $translations)) {
                    $value = $translations[$value];
                }

                return $element . 'placeholder="' . $value . '"' . $matches[4];
            },
            $fileContent
        );

        $translationTransporter->setFileContent($fileContent);

        return $next($translationTransporter);
    }
}
