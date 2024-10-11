<?php

namespace Tschucki\TranslateJetstream\Commands;

use Illuminate\Console\Command;

class TranslateJetstreamCommand extends Command
{
    public $signature = 'translate-jetstream';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
