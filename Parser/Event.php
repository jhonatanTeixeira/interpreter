<?php

namespace Parser;

use Symfony\Component\EventDispatcher;
use Parser\Syntax;
use Doctrine\DBAL\Query\QueryBuilder;

class Event extends EventDispatcher\Event
{
    /**
     * @var Syntax
     */
    private $syntax;
    
    /**
     * @var QueryBuilder
     */
    private $queryBuilder;
    
    public function __construct(Syntax $syntax)
    {
        $this->syntax = $syntax;
    }

    /**
     * @return Syntax
     */
    public function getSyntax()
    {
        return $this->syntax;
    }
    
    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->queryBuilder;
    }

    public function setQueryBuilder(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }
}
