<?php

namespace Parser\Syntax\Tree;

use Lexer\Token\Stream;
use Parser\Syntax;

class Builder
{
    public function createSyntaxTree()
    {
        $syntaxTree = new Syntax\Tree();
        $select     = new Syntax\Select();
        $table      = new Syntax\Table();
        
        $select->addChild($table);
        $syntaxTree->addSyntax($select);
        
        return $syntaxTree;
    }
    
    public function createAbstractSyntaxTree(Stream $tokenStream, Syntax\Tree $syntaxTree)
    {
        $abstractSyntaxTree = new Syntax\Tree();
        
        /* @var $syntax Syntax */
        foreach ($syntaxTree as $syntax) {
            $abstractSyntax = clone $syntax;
            
            if ($abstractSyntax->acceptToken($tokenStream)) {
                $abstractSyntaxTree->addSyntax($abstractSyntax);
            }
                
            if (!$syntax instanceof NodeInterface) {
                continue;
            }

            if (!$syntax->hasChildren()) {
                continue;
            }
            
            foreach ($this->createAbstractSyntaxTree($tokenStream, $syntax->getChildren()) as $childSyntax) {
                $abstractSyntax->addChild($childSyntax);
            }
        }
        
        if ($tokenStream->getIterator()->valid()) {
            throw new \Parser\Exception('Too many arguments');
        }
        
        return $abstractSyntaxTree;
    }
}
