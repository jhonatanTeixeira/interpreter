<?php

namespace Parser\Event;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Dispatcher extends EventDispatcher
{
    /**
     * @var QueryBuilder
     */
    private $queryBuilder;
    
    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }
    
    public function dispatch($eventName, Event $event = null)
    {
        if (null === $event) {
            throw new \Parser\Exception('event must not be null');
        }
        
        if (!$event instanceof \Parser\Event) {
            throw new \Parser\Exception('event must be instance of Parser\Event');
        }
        
        $event->setQueryBuilder($this->queryBuilder);
        
        return parent::dispatch($eventName, $event);
    }
    
    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
        if (!$subscriber instanceof Subscriber) {
            throw new \Parser\Exception('subscriber must be instance of Parser\Event\Subscriber');
        }
        
        parent::addSubscriber($subscriber);
    }
    
    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->queryBuilder;
    }
}
