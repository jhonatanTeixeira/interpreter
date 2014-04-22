<?php

namespace Lexer;

use Lexer\Symbol;

class Token
{
    private $match;

    private $symbol;

    public function getMatch()
    {
        return $this->match;
    }

    public function getSymbol()
    {
        return $this->symbol;
    }

    public function setMatch($match)
    {
        $this->match = $match;
    }

    public function setSymbol(Symbol $symbol)
    {
        $this->symbol = $symbol;
    }
}
