<?php

namespace Tschucki\TranslateJetstream\Translators\TranslateOperations;

use Closure;
use Tschucki\TranslateJetstream\Contracts\TranslateOperation;
use Tschucki\TranslateJetstream\Transporters\TranslationTransporter;

class TranslateElementValues implements TranslateOperation
{
    public function getPattern(): string
    {
        // i only want to translate the values of elements for example in  <InputLabel for="email" value="Email" /> i want to translate the value "Email"
        return '/(<[^>]+)(value="([^"]*)")([^>]*>)/';
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

                return $element.'value="'.$value.'"'.$matches[4];
            },
            $fileContent
        );

        $translationTransporter->setFileContent($fileContent);

        return $next($translationTransporter);
    }
}
