<?php
namespace AsyncScraper;

final class Company
{
    /**
     * @var string
     */
    public $data;
    
    public function __construct(string ...$data)
    {
        $this->data = $data;
    }

    public function toArray(): array
    {
        return [
            'data' => json_encode($this->data)
        ];
    }
}