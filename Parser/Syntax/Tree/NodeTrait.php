<?php

namespace Parser\Syntax\Tree;

use Parser\Syntax;
use Parser\Syntax\Visitor;

trait NodeTrait
{
    private $children;

    public function addChild(Syntax $syntax)
    {
        if (null === $this->children) {
            $this->initChildren();
        }
        
        $this->children->addSyntax($syntax);
    }

    public function getChildren()
    {
        return $this->children;
    }
    
    public function hasChildren()
    {
        return count($this->children) > 0;
    }
    
    public function __clone()
    {
        $this->initChildren();
    }
    
    public function acceptVisitor(Visitor $visitor)
    {
        parent::acceptVisitor($visitor);
        
        if ($this->hasChildren()) {
            foreach ($this->getChildren() as $child) {
                $child->acceptVisitor($visitor);
            }
        }
    }
    
    private function initChildren()
    {
        $this->children = new \Parser\Syntax\Tree();
    }
}
