<?php

namespace Tschucki\TranslateJetstream\Translators\TranslateOperations;

use Closure;
use Tschucki\TranslateJetstream\Contracts\TranslateOperation;
use Tschucki\TranslateJetstream\Transporters\TranslationTransporter;

class TranslateSpecialComponentContent implements TranslateOperation
{
    public function getPattern(): string
    {
        return '/>([^<]+)</';
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
            static function ($matches) use ($translations) {
                $text = trim($matches[1]);

                // Preserve line breaks before and after the text
                $textWithLineBreaks = str_replace("\n", '\\n', $text);

                if (array_key_exists($textWithLineBreaks, $translations)) {
                    return '>'.str_replace('\\n', "\n", $translations[$textWithLineBreaks]).'<';
                }

                return $matches[0];
            },
            $content
        );
    }
}
