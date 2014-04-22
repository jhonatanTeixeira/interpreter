<?php

namespace Parser\Syntax\Tree;

use Parser\Syntax;

interface NodeInterface
{
    public function addChild(Syntax $syntax);
    
    public function hasChildren();
    
    public function getChildren();
}