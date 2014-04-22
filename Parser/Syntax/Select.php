<?php

namespace Parser\Syntax;

use Parser\Syntax;
use Parser\Syntax\Tree;
use Parser\Syntax\Traits;

class Select extends Syntax implements Tree\NodeInterface
{
    use Tree\NodeTrait, Traits\AcceptWordSymbol;
    
    public function getRegexp()
    {
        return '/select/';
    }
    
    public function isMandatory()
    {
        return false;
    }

    public function getVisitorDispatchEventName()
    {
        return 'select';
    }

}
