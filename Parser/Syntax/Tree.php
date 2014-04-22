<?php

namespace Parser\Syntax;

class Tree implements \RecursiveIterator
{
    use \Collection\Traits\Iterator {append as private;}
    
    public function __construct()
    {
        $this->data = new \ArrayIterator();
    }
    
    public function getChildren()
    {
        return $this->current()->getChildren();
    }

    public function hasChildren()
    {
        if ($this->current() instanceof Tree\NodeInterface && $this->current()->hasChildren()) {
            return true;
        }
        
        return false;
    }

    public function addSyntax(\Parser\Syntax $syntax)
    {
        $this->append($syntax);
    }
    
    public function visitAll(Visitor $visitor)
    {
        foreach ($this as $syntax) {
            $syntax->acceptVisitor($visitor);
        }
    }
}
