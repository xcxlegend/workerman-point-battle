<?php 

namespace Server;

class Map{
    public $size = [];

    public function __construct(array $size)
    {
        $this->size = $size;
    }

    public function randPos()
    {
        return [
            rand(0, $this->size[0]),
            rand(0, $this->size[1])
        ];
    }


}

