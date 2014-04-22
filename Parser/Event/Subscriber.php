<?php

namespace Parser\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Parser\Event;

abstract class Subscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(static::getEventName() => array('onVisit', 0));
    }
    
    abstract public static function getEventName();
    
    abstract public function onVisit(Event $event);
}
