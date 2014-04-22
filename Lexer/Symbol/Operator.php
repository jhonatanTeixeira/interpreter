<?php

namespace Lexer\Symbol;

use Lexer\Symbol;

class Operator implements Symbol
{
    public function getName()
    {
        return 'operator';
    }

    public function getRegexp()
    {
        return '/^(=)|(<)|(>)|(<=)|(>=)|(!=)/';
    }
}
