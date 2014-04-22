<?php

namespace Parser;

use Lexer\Token;

abstract class Syntax
{
    private $token;
    
    public function acceptToken(Token\Stream $tokenStream)
    {
        $tokenQueue = $tokenStream->getIterator();
        
        if (!$tokenQueue->valid()) {
            if ($this->isMandatory()) {
                throw new Exception("incomplete comand " . $this->getRegexp() . ' expected');
            }
            
            return false;
        }
        
        $token      = $tokenQueue->current();
        $symbolType = $this->getSymbolType();
        
        if ($token->getSymbol() instanceof $symbolType) {
            if (preg_match($this->getRegexp(), $token->getMatch())) {
                $this->token = $token;
                $tokenQueue->next();
                return true;
            }
        }
        
        if ($this->isMandatory()) {
            throw new Exception("Expected {$this->getRegexp()}, but found {$token->getMatch()}");
        }
        
        return false;
    }
    
    /**
     * @return Token
     */
    public function getToken()
    {
        return $this->token;
    }

    public function acceptVisitor(Syntax\Visitor $visitor)
    {
        $visitor->visit($this);
    }
    
    /**
     * @return string Symbol Class name
     */
    public abstract function getSymbolType();
    
    public abstract function getRegexp();
    
    public abstract function isMandatory();
    
    public abstract function getVisitorDispatchEventName();
}
