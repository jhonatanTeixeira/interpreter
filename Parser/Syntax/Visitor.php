<?php

namespace Parser\Syntax;

use Parser\Syntax;
use Parser\Event;
use Parser\Event\Dispatcher;

class Visitor
{
    /**
     * @var Dispatcher
     */
    private $eventDispatcher;
    
    public function __construct(Dispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }
    
    public function visit(Syntax $syntax)
    {
        $event = new Event($syntax);
        
        $this->eventDispatcher->dispatch($syntax->getVisitorDispatchEventName(), $event);
    }
}
