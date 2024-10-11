<?php

namespace Tschucki\TranslateJetstream\Contracts;

use Closure;
use Tschucki\TranslateJetstream\Transporters\TranslationTransporter;

interface TranslateOperation
{
    public function getPattern(): string;
    public function handle(TranslationTransporter $translationTransporter, Closure $next);
}
