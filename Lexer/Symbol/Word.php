<?php

namespace Lexer\Symbol;

use Lexer\Symbol;

class Word implements Symbol
{
    public function getName()
    {
        return 'WORD';
    }

    public function getRegexp()
    {
        return '/^[a-z0-9^\.]+/i';
    }
}
