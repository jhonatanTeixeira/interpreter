<?php

namespace Parser\Event;

class From extends Subscriber
{
    public static function getEventName()
    {
        return 'from';
    }

    public function onVisit(\Parser\Event $event)
    {
        $tableName = $event->getSyntax()->getToken()->getMatch();
        $event->getQueryBuilder()->from($tableName, null);
    }

}
