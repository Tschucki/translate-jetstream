<?php

namespace Tschucki\TranslateJetstream\Translators\TranslateOperations;

use Closure;
use Tschucki\TranslateJetstream\Contracts\TranslateOperation;
use Tschucki\TranslateJetstream\Transporters\TranslationTransporter;

class TranslateComponentContent implements TranslateOperation
{
    public function getPattern(): string
    {
        return '/(<[^>]+>)([^<]*)(<\/[^>]+>)/';
    }

    public function handle(TranslationTransporter $translationTransporter, Closure $next)
    {
        $fileContent = $translationTransporter->getFileContent();
        $translations = $translationTransporter->getTranslations();

        $fileContent = preg_replace_callback(
            $this->getPattern(),
            static function ($matches) use ($translations) {
                $element = $matches[0];
                $elementContent = $matches[2];
                $elementContent = trim($elementContent);
                $elementContent = str_replace(["\n", "\r", "\t"], '', $elementContent);

                if (array_key_exists($elementContent, $translations)) {
                    $translation = $translations[$elementContent];
                    return $matches[1] . str_replace($elementContent, $translation, $elementContent) . $matches[3];
                }

                return $element;
            },
            $fileContent
        );

        $translationTransporter->setFileContent($fileContent);

        return $next($translationTransporter);
    }
}
