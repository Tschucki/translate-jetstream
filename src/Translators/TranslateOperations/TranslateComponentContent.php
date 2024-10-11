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

        $fileContent = $this->translateContent($fileContent, $translations);

        $translationTransporter->setFileContent($fileContent);

        return $next($translationTransporter);
    }

    private function translateContent(string $content, array $translations): string
    {
        return preg_replace_callback(
            $this->getPattern(),
            function ($matches) use ($translations) {
                $element = $matches[1];
                $elementContent = $matches[2];
                $closingTag = $matches[3];

                $elementContent = $this->translateContent($elementContent, $translations);

                if (array_key_exists(trim($elementContent), $translations)) {
                    $elementContent = $translations[trim($elementContent)];
                }

                return $element.$elementContent.$closingTag;
            },
            $content
        );
    }
}
