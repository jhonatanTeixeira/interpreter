<?php

namespace Lexer\Token;

use Lexer\Token;

class Stream implements \IteratorAggregate
{
    private $tokens;
    
    public function __construct()
    {
        $this->tokens = new \SplQueue();
        $this->tokens->setIteratorMode(\SplQueue::IT_MODE_DELETE);
    }

    public function addToken(Token $token)
    {
        $this->tokens->push($token);
    }

    /**
     * @return \SplQueue
     */
    public function getIterator()
    {
        $this->tokens->rewind();
        return $this->tokens;
    }
}
