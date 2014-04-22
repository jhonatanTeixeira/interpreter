<?php

$txt = 'select Table table where table.name = name;';

interface Symbol
{
    public function getName();

    public function getRegexp();
}

class Word implements Symbol
{
    public function getName()
    {
        return 'WORD';
    }

    public function getRegexp()
    {
        return '/((?:[a-z][a-z]+))/i';
    }
}

class QualifiedName implements Symbol
{
    public function getName()
    {
        return 'qualified-name';
    }

    public function getRegexp()
    {
        return '/((?:[a-z][a-z\\.\\d\\-]+)\\.(?:[a-z][a-z\\-]+))(?![\\w\\.])/i';
    }
}

class Operator implements Symbol
{
    public function getName()
    {
        return 'operator';
    }

    public function getRegexp()
    {
        return '/(=)|(<)|(>)|(<=)|(>=)|(!=)/';
    }
}

class EndSymbol implements Symbol
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

class SymbolTable extends SplDoublyLinkedList
{
    public function __construct()
    {
        $this->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO | SplDoublyLinkedList::IT_MODE_DELETE);
    }
}

class SymbolTableFactory
{
    public function createSymbolTable()
    {
        $symbolTable = new SymbolTable();
        $symbolTable->push(new Word());
        $symbolTable->push(new Word());
        $symbolTable->push(new Word());
        $symbolTable->push(new Word());
        $symbolTable->push(new QualifiedName());
        $symbolTable->push(new Operator());
        $symbolTable->push(new Word());
        $symbolTable->push(new EndSymbol());

        return $symbolTable;
    }
}

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

class TokenStream implements IteratorAggregate
{
    public function __construct()
    {
        $this->tokens = new ArrayIterator();
    }

    public function addToken(Token $token)
    {
        $this->tokens[] = $token;
    }

    public function getIterator()
    {
        return $this->tokens;
    }
}

class Lexer
{
    public function tokenize(SymbolTable $symbolTable, $expression)
    {
        $tokens = new TokenStream;
        
        foreach ($symbolTable as $symbol) {
            $regexp = $symbol->getRegexp();

            if (preg_match($regexp, $expression, $match)) {
                $token = new Token();
                $token->setMatch($match[0]);
                $token->setSymbol($symbol);
                $expression = preg_replace($regexp, '', $expression, 1);

                $tokens->addToken($token);
            }
        }

        return $tokens;
    }
}

class ParseTree
{
    private $rootNode;
    
    public function getRootNode()
    {
        return $this->rootNode;
    }

    public function setRootNode(Syntax $rootNode)
    {
        $this->rootNode = $rootNode;
    }
}

interface ParseTreeNode
{
    public function getChild();
    
    public function addChild(Syntax $syntax);
}

interface RepeatanceNode
{
    public function getSyntaxes();
    
    public function addSyntax(Syntax $syntax);
}

interface Syntax
{
    public function accept(Token $token);
}

class SyntaxException extends Exception
{
    public function __construct($expected, $found)
    {
        $message = sprintf("expected %s but found %s", $expected, $found);
        parent::__construct($message);
    }
}

class SelectSyntax implements Syntax, ParseTreeNode
{
    public function accept(Token $token)
    {
        
    }

    public function addChild(Syntax $syntax)
    {
        
    }

    public function getChild()
    {
        
    }
}

$lexer = new Lexer();

$symbolTable = (new SymbolTableFactory)->createSymbolTable();

$tokenStream = $lexer->tokenize($symbolTable, $txt);

var_dump($tokenStream);