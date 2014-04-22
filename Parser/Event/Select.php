<?php

namespace Parser\Event;

class Select extends Subscriber
{
    public static function getEventName()
    {
        return 'select';
    }

    public function onVisit(\Parser\Event $event)
    {
        $event->getQueryBuilder()->select('*');
    }

}
