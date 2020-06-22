<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();
$browser = new \Clue\React\Buzz\Browser($loop);
$scraper = new \AsyncScraper\Scraper($browser);

$urls = [
    'http://www.mycorporateinfo.com/business/kamdhenu-engineering-industries-ltd',
    'http://www.mycorporateinfo.com/business/mardia-farms-limited'
];

$storage = new \AsyncScraper\Storage($loop, 'root:123456@localhost/php_dom_parsing');
$scraper->scrape(...$urls)->then(
    function (array $companies) use ($storage){
        $storage->save(...$companies);        
        $storage->quit();
    }
);

$loop->run();