<?php
// http://www.mycorporateinfo.com/business/kamdhenu-engineering-industries-ltd

use Clue\React\Buzz\Browser;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler;

require __DIR__ . '/vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();

$browser = new Browser($loop);

$browser
->get('http://www.mycorporateinfo.com/business/kamdhenu-engineering-industries-ltd')
->then(function (ResponseInterface $response) {
    $crawler = new Crawler((string) $response->getBody());
    $data = $crawler->filter('#companyinformation table tbody tr td')->extract(['_text']);
    foreach($data as $key => $value) if(!($key&1)) unset($data[$key]);
    print_r($data);
});
//#companyinformation
$loop->run();