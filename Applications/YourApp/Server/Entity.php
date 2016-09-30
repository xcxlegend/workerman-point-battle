<?php 

namespace Server;

abstract class Entity{
    public $id;
    public $type;
    public $pos;  // origin position
    public $r;    
    public $canMove = false;
    public $moveToward = 0;  // 1,-1,2,-2

    public function init()
    {
        
    }

    public function destroy()
    {
        
    }

    public function toArray()
    {
        return [
            'id'            => $this->id,
            'type'          => $this->type,
            'pos'           => $this->pos,
            'r'             => $this->r,
            'canMove'       => $this->canMove,
            'moveToward'    => $this->moveToward,
        ];
    }

}


/**
 
    Map size[size, size]
    entity -> type {player, gamer, mob, prop, area}
    


 */