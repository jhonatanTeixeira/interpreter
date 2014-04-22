<?php

namespace Lexer\Symbol;

use Lexer\Symbol;

class End implements Symbol
{
    public function getName()
    {
        return 'end-symbol';
    }

    public function getRegexp()
    {
        return '/;/';
    }
}
