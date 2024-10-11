<?php

namespace Tschucki\TranslateJetstream\Transporters;

class TranslationTransporter
{
    private array $translations;

    private string $fileContent;

    public function __construct(array $translations, string $fileContent)
    {
        $this->translations = $translations;
        $this->fileContent = $fileContent;
    }

    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function setTranslations(array $translations): void
    {
        $this->translations = $translations;
    }

    public function setFileContent(string $fileContent): void
    {
        $this->fileContent = $fileContent;
    }

    public function getFileContent(): string
    {
        return $this->fileContent;
    }
}
