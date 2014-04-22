<?php

namespace Lexer\Symbol;

use Lexer\Symbol;

class Table implements \IteratorAggregate
{
    private $table;
    
    public function __construct()
    {
        $this->table = new \ArrayIterator();
    }
    
    public function addSymbol(Symbol $symbol)
    {
        $this->table[] = $symbol;
    }
    
    public function getIterator()
    {
        return $this->table;
    }
}
