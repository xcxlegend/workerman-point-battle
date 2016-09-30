<?php 

namespace Server;

class Player extends Entity{

    public $nick;
    public $client_id;
    public $weight = 2;
    public $canMove = true;
    public $moveToward = Constants::TOWARD_RIGHT;
    public $r = 15;
    public $speed = 20;

    public function __construct($client_id, $id, $nick, $pos)
    {
        $this->pos          = $pos;
        $this->id           = $id;
        $this->nick         = $nick;
        $this->client_id    = $client_id;
        $this->type         = Constants::ENTITY_TYPE_PLAYER;
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['nick'] = $this->nick;
        $array['weight'] = $this->weight;
        $array['speed'] = $this->speed;
        return $array;
    }

}