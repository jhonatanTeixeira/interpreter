<?php

namespace Parser\Event\Dispatcher;

use Parser\Event;
use Doctrine\DBAL\Query\QueryBuilder;

class Factory
{
    public function createEventDispatcherWithSubscribers(QueryBuilder $queryBuilder)
    {
        $selectSubscriber = new Event\Select();
        $fromSubscriber   = new Event\From();
        
        $eventDispatcher = new Event\Dispatcher($queryBuilder);
        $eventDispatcher->addSubscriber($selectSubscriber);
        $eventDispatcher->addSubscriber($fromSubscriber);
        
        return $eventDispatcher;
    }
}
