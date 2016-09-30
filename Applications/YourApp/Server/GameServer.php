<?php 

namespace Server;

use \Workerman\Lib\Timer;

class GameServer{

    public $players;
    public $entities;
    public $GameServer;
    public $mobs;
    public $props;
    public $entityId = 1;
    public $map;

    public function __construct()
    {
        $this->map = new Map([980, 540]);
        // Timer::add(1, [$this, 'checkMobCount'], [], true);
        // Timer::add(2, [$this, 'checkPropCount'], [], true);
    }

    public function checkMobCount()
    {
        if (count($this->mobs) < 20){

        }
        $this->mobs++;
    }

    public function checkPropCount()
    {
        
    }


    public function addMob()
    {
        # code...
    }

    public function createId()
    {
        return $this->entityId++;
    }

    public function createEntity($entity)
    {
        
    }

    public function createNewPlayer($client_id, $nick)
    {
        $id = $this->createId();
        $player = new Player($client_id, $id, $nick, $this->map->randPos());
        $this->entities[$id] = $player;
        $this->gamers[$id] = $player;
        $this->players[$client_id] = $player;
        Message::player_join($player);
        return $player;
    }

    public function onConnect($client_id)
    {
        $gameInfo = $this->formatGameInfo();
        Message::mapRefreshToClient($client_id, $gameInfo);
    }

    public function onClientLeave($client_id)
    {
        $player = isset($this->players[$client_id]) ? $this->players[$client_id] : null;
        if ($player){
            $id = $player->id;
            unset($this->players[$client_id], $this->entities[$id], $this->gamers[$id]);
            Message::entityRemove($player);
        }
    }

    public function onClientGamerMove($client_id, $id, $pos)
    {
        $entity = $this->entities[$id];
        $entity->pos = $pos;
        Message::entityMove($entity, $pos, [$client_id]);
    }

    public function formatGameInfo()
    {
        return [
            'entities' => $this->entities,
            'map'      => $this->map
        ];
    }


}