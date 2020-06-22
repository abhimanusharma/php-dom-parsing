<?php
namespace AsyncScraper;

use \React\EventLoop\LoopInterface;
use \React\MySQL\Factory;
use \React\MySQL\QueryResult;

final class Storage 
{
    private $connection;

    public function __construct(LoopInterface $loop, string $uri)
    {
        $this->connection = (new Factory($loop))->createLazyConnection($uri);
    }

    public function save(Company ...$companies): void 
    {
        $sql = 'INSERT INTO company (cin, name, status, age, registration_number, category, subcategory, class, roc_code, total_members) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

        foreach ($companies as $company){
            $this->connection->query($sql, $company->toArray())
                ->then(function (QueryResult $result) {
                    var_dump($result);
                }, function (Exception $exception) {
                    echo $exception->getMessage() . PHP_EOL;
                });
        }
    }

    public function quit(): void
    {
        $this->connection->quit();
    }
}