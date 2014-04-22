<?php

namespace Lexer\Symbol;

use Lexer\Symbol;

class Aggregate implements Symbol
{
    public function getName()
    {
        return 'AGGREGATE';
    }

    public function getRegexp()
    {
        return '/^And |^Or /';
    }

}
