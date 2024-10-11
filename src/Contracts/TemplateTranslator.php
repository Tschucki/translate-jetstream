<?php

namespace Tschucki\TranslateJetstream\Contracts;

use Symfony\Component\Finder\SplFileInfo;

interface TemplateTranslator
{
    // This interface gets implemented by the Translator classes. They are responsible for translating the Jetstream templates like Vue Components or React Components or Blade Views.
    // Der Translator soll einer Struktur folgen, die immer gleich ist. Jeder Translator hat zum Beispiel eine andere Herangehensweise um Buttons, Data-Attributes oder Headlines zu übersetzen
    // Diese nötigen Varianten sollen bereits im Interface definiert werden, damit die Implementierung in den Klassen einheitlich ist.
    // Die Implementierung der Methoden ist in den Klassen selbst zu finden.
    // Jeder Translator braucht einen public array in dem die Übersetzungen gespeichert sind. Die Keys sind die Originalen Strings und die Values sind die Übersetzungen.
    // In den Templates wird dann der Original-String durch den Value ersetzt. Die Datei wird dann überschrieben, so dass der Original-String nicht mehr vorhanden ist.

    public function getTranslations(): array;

    public function setTranslations(array $translations): void;

    public function getFileContent(): string;

    public function setFileContent(string $fileContent): void;

    public function getFile(): SplFileInfo;

    public function setFile(SplFileInfo $file): void;

    public function getTranslationPipes(): array;

    public function translate(): void;
}
