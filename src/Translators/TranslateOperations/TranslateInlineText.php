<?php

namespace Tschucki\TranslateJetstream\Translators\TranslateOperations;

use Closure;
use Tschucki\TranslateJetstream\Contracts\TranslateOperation;
use Tschucki\TranslateJetstream\Transporters\TranslationTransporter;

class TranslateInlineText implements TranslateOperation
{
    public function getPattern(): string
    {
        return '/>(\s*)([^<{]+?)(\s*)(<|{{)/';
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
                $leadingSpace = $matches[1];
                $text = $matches[2];
                $trailingSpace = $matches[3];
                $suffix = $matches[4];

                if (array_key_exists($text, $translations)) {
                    return '>' . $leadingSpace . $translations[$text] . $trailingSpace . $suffix;
                }

                return $matches[0];
            },
            $content
        );
    }
}
