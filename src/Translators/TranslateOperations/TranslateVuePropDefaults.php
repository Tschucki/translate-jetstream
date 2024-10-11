<?php

namespace Tschucki\TranslateJetstream\Translators\TranslateOperations;

use Closure;
use Tschucki\TranslateJetstream\Contracts\TranslateOperation;
use Tschucki\TranslateJetstream\Transporters\TranslationTransporter;

class TranslateVuePropDefaults implements TranslateOperation
{
    public function getPattern(): string
    {
        return '/default:\s*([\'"])(.*?)\1/';
    }

    public function handle(TranslationTransporter $translationTransporter, Closure $next)
    {
        $fileContent = $translationTransporter->getFileContent();
        $translations = $translationTransporter->getTranslations();

        $fileContent = preg_replace_callback(
            $this->getPattern(),
            static function ($matches) use ($translations) {
                $translation = $translations[$matches[2]] ?? null;
                return $translation ? "default: '{$translation}'" : $matches[0];
            },
            $fileContent
        );

        $translationTransporter->setFileContent($fileContent);

        return $next($translationTransporter);
    }
}
