<?php

namespace Lexer;

use Lexer\Symbol\Table;

class Tokenizer
{
    public function tokenize(Table $symbolTable, $expression)
    {
        $tokens = new Token\Stream();
        
        $symbols = $symbolTable->getIterator();
        $symbols->rewind();
        
        while ($symbols->valid()) {
            $symbol = $symbols->current();
            
            $regexp = $symbol->getRegexp();

            if (preg_match($regexp, $expression, $match)) {
                $token = new Token();
                $token->setMatch($match[0]);
                $token->setSymbol($symbol);
                $expression = trim(preg_replace($regexp, '', $expression, 1));

                $tokens->addToken($token);
                $symbols->rewind();
                continue;
            }
            
            $symbols->next();
        }

        return $tokens;
    }
}
