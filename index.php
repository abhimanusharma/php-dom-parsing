<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';

use \React\MySQL\QueryResult;

$loop = \React\EventLoop\Factory::create();
$browser = new \Clue\React\Buzz\Browser($loop);
$scraper = new \AsyncScraper\Scraper($browser);

$urls = [
    'http://www.mycorporateinfo.com/business/kamdhenu-engineering-industries-ltd',
    'http://www.mycorporateinfo.com/business/mardia-farms-limited'
];

$factory = new \React\MySQL\Factory($loop);
$connection = $factory->createLazyConnection('root:123456@localhost/php_dom_parsing');
$scraper->scrape(...$urls)->then(
    function (array $companies) use ($connection){
        $sql = 'INSERT INTO company (cin, name, status, age, registration_number, category, subcategory, class, roc_code, total_members) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

        foreach ($companies as $company){
            $connection->query($sql, $company->toArray())
                ->then(function (QueryResult $result) {
                    var_dump($result);
                }, function (Exception $exception) {
                    echo $exception->getMessage() . PHP_EOL;
                });
        }
    }
);

$loop->run();