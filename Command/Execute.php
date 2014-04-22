<?php

namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Execute extends Command
{
    protected function configure()
    {
        $this->setName('dsl:execute');
        $this->addArgument('dsl', InputArgument::REQUIRED, "the dsl command to execute");
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $inputString = $input->getArgument('dsl');
        
        $symbolTable = (new \Lexer\Symbol\Table\Factory())->createSymbolTable();
        $tokenizer   = new \Lexer\Tokenizer();
        $tokenStream = $tokenizer->tokenize($symbolTable, $inputString);
        
        $treeBuilder = new \Parser\Syntax\Tree\Builder();
        $syntaxTree = $treeBuilder->createSyntaxTree();
        
        $abstractSyntaxTree = $treeBuilder->createAbstractSyntaxTree($tokenStream, $syntaxTree);
        
        $config = new \Doctrine\DBAL\Configuration();
        
        $connectionParams = array(
            'dbname' => 'mydb',
            'user' => 'user',
            'password' => 'secret',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );
        
        $connection = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
        
        $queryBuilder = new \Doctrine\DBAL\Query\QueryBuilder($connection);
        
        $dispatcher = (new \Parser\Event\Dispatcher\Factory())->createEventDispatcherWithSubscribers($queryBuilder);
        
        $visitor = new \Parser\Syntax\Visitor($dispatcher);
        $abstractSyntaxTree->visitAll($visitor);
        
        $output->writeln($queryBuilder->getSQL());
    }
}
