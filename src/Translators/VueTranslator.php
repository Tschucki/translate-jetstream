<?php

namespace Tschucki\TranslateJetstream\Translators;

use Illuminate\Pipeline\Pipeline;
use Symfony\Component\Finder\SplFileInfo;
use Tschucki\TranslateJetstream\Contracts\TemplateTranslator;
use Tschucki\TranslateJetstream\Translators\TranslateOperations\TranslateComponentContent;
use Tschucki\TranslateJetstream\Translators\TranslateOperations\TranslateElementTitles;
use Tschucki\TranslateJetstream\Translators\TranslateOperations\TranslateElementValues;
use Tschucki\TranslateJetstream\Translators\TranslateOperations\TranslateVuePropDefaults;
use Tschucki\TranslateJetstream\Transporters\TranslationTransporter;

class VueTranslator implements TemplateTranslator
{
    public array $translations;
    public SplFileInfo $file;

    public function __construct(SplFileInfo $file, array $translations)
    {
        $this->setFile($file);
        $this->setTranslations($translations);
    }

    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function setTranslations(array $translations): void
    {
        // sort the translations by key length, so that the longest keys are translated first

        uksort($translations, static function ($a, $b) {
            return strlen($b) <=> strlen($a);
        });

        $this->translations = $translations;
    }

    public function translate(): void
    {
        // pass the file content through a pipeline of translation methods
        // at the end of the pipeline, the file content is written back to the file with setFileContent()

        $translationTransporter = new TranslationTransporter(
            $this->getTranslations(),
            $this->getFileContent()
        );

        app(abstract: Pipeline::class)
            ->send($translationTransporter)
            ->through($this->getTranslationPipes())
            ->then(fn(TranslationTransporter $translationTransporter) => $this->setFileContent($translationTransporter->getFileContent()));
    }

    public function getTranslationPipes(): array
    {
        return [
            TranslateComponentContent::class,
            TranslateElementValues::class,
            TranslateElementTitles::class,
            TranslateVuePropDefaults::class,
        ];
    }

    public function getFileContent(): string
    {
        return $this->getFile()->getContents();
    }

    public function setFileContent(string $fileContent): void
    {
        $this->getFile()->openFile('w')->fwrite($fileContent);
    }

    public function getFile(): SplFileInfo
    {
        return $this->file;
    }

    public function setFile(SplFileInfo $file): void
    {
        $this->file = $file;
    }
}
