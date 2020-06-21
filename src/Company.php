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
            'cin' => $this->data[0],
            'name' => $this->data[1],
            'status' => $this->data[2],
            'age' => $this->data[3],
            'registration_number' => $this->data[4],
            'category' => $this->data[5],
            'subcategory' => $this->data[6],
            'class' => $this->data[7],
            'roc_code' => $this->data[8],
            'total_members' => $this->data[9]
        ];
    }
}