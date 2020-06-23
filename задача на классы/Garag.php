<?php


class Garag
{
    public $garag;
    public function __construct(array $cars,  $garag)
    {
        $this->garag = $garag;
        $this->cars = $cars;
    }
}