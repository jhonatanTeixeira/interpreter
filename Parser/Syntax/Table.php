<?php

namespace Parser\Syntax;

use Parser\Syntax\Traits;

class Table extends \Parser\Syntax
{
    use Traits\AcceptWordSymbol, Traits\AlphaRegexp;

    public function isMandatory()
    {
        return true;
    }

    public function getVisitorDispatchEventName()
    {
        return 'from';
    }
}
