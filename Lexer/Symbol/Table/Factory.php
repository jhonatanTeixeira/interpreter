<?php

namespace Lexer\Symbol\Table;

use Lexer\Symbol\Table;
use Lexer\Symbol\Word;
use Lexer\Symbol\QualifiedName;
use Lexer\Symbol\Operator;
use Lexer\Symbol\End;

class Factory
{
    public function createSymbolTable()
    {
        $symbolTable = new Table();
        $symbolTable->addSymbol(new Word());
        $symbolTable->addSymbol(new QualifiedName());
        $symbolTable->addSymbol(new Operator());
        $symbolTable->addSymbol(new End());

        return $symbolTable;
    }
}
