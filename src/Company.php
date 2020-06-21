<?php

namespace AsyncScraper;

final class Company
{
    public $data;
    
    public function __construct(string ...$data)
    {
        $this->data = $data;
    }
}