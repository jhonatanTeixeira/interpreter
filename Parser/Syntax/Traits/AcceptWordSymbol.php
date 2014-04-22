<?php

namespace Parser\Syntax\Traits;

trait AcceptWordSymbol
{
    public function getSymbolType()
    {
        return 'Lexer\Symbol\Word';
    }
}
