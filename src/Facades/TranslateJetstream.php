<?php

namespace Tschucki\TranslateJetstream\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tschucki\TranslateJetstream\TranslateJetstream
 */
class TranslateJetstream extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Tschucki\TranslateJetstream\TranslateJetstream::class;
    }
}
