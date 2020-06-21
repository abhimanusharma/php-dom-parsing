<?php

namespace AsyncScraper;

use Clue\React\Buzz\Browser;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler;
use React\Promise\PromiseInterface;
use function React\Promise\all;


final class Scraper 
{
    private $browser;

    public function __construct(Browser $browser)
    {
        $this->browser = $browser;
    }

    public function scrape(string ...$urls) : PromiseInterface
    {
        $promises = array_map(function($url){
            return $this->extractFromUrl($url);
        }, $urls);
        
        return all($promises);
    }

    private function extract(string $responseBody): Company
    { 
        $crawler = new Crawler($responseBody);
        $data = $crawler->filter('#companyinformation table tbody tr td')
        ->extract(['_text']);
        return new Company($data);
    }

    private function extractFromUrl($url): PromiseInterface
    {
        return $this->browser->get($url)
        ->then(function(ResponseInterface $response){
            return $this->extract((string) $response->getBody());
        });
    }
}