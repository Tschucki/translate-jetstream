<?php

namespace Tschucki\TranslateJetstream\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Tschucki\TranslateJetstream\Translators\VueTranslator;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\error;
use function Laravel\Prompts\note;
use function Laravel\Prompts\select;

class TranslateJetstreamCommand extends Command
{
    public $signature = 'jetstream:translate {locale?}';

    public $description = 'My command';

    public function handle(): int
    {
        $stack = config('jetstream.stack');

        $locale = $this->getLocale();

        $this->displayInfo($stack, $locale);

        $this->prepareTranslations($locale);


        $translations = json_decode(file_get_contents(base_path("lang/{$locale}.json")), true, 512, JSON_THROW_ON_ERROR);

        match ($stack) {
            'inertia' => $this->translateInertia($translations),
        };

        return 1;
    }

    protected function getLocale()
    {
        $locale = $this->argument('locale');

        if ($locale) {
            return $locale;
        }

        $locales = collect(File::directories(base_path('vendor/laravel-lang/lang/locales')))->map(function ($directory) {
            return basename($directory);
        })->toArray();

        return select('Select a locale to translate', $locales, 'de');
    }

    protected function displayInfo($stack, $locale)
    {
        note("You have chosen to translate Jetstream to the {$locale} locale using the {$stack} stack.");
    }

    protected function prepareTranslations($locale)
    {
        if (File::exists(base_path("lang/{$locale}.json"))
            &&
            confirm("The {$locale} locale already exists. Do you want to update it?")) {
            info("Updating your locale from laravel-lang");
            $code = Artisan::call('lang:update');
            if ($code === 0) {
                info("Locale updated successfully");
            } else {
                error("An error occurred while updating the locale");
            }
        } else if (confirm('The locale does not exist. Do you want to create it?')) {
            info("Adding your locale from laravel-lang");
            $code = Artisan::call('lang:add', ['locales' => $locale]);
            if ($code === 0) {
                info("Locale added successfully");
            } else {
                error("An error occurred while adding the locale");
            }
        }
    }

    protected function translateInertia($translations)
    {
        $finder = new Finder();
        $finder->files()->in(resource_path("js"))->name('*.vue');


        $this->withProgressBar($finder, function (SplFileInfo $file) use ($translations) {
            $translator = new VueTranslator($file, $translations);
            $translator->translate();
        });
    }
}
