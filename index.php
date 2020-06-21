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

$scraper->scrape(... $urls)->then('print_r');

$loop->run();