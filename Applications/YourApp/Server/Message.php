<?php 

namespace Server;
use \GatewayWorker\Lib\Gateway;

class Message{

    public static function serialize()
    {
        # code...
    }

    public static function player_join(Player $player)
    {
        $msg = json_encode([
            'data'    => ['player' => $player->toArray()],
            'action'  => Constants::MESSAGE_PLAYER_JOIN
        ]);
        Gateway::sendToCurrentClient($msg);
        static::entityCreate([$player], true);
    }

    public static function entityMove($entity, $pos, $exclude_client_id = null)
    {
        $msg = json_encode([
            'data'    => ['id' => $entity->id, 'pos' => $pos],
            'action'  => Constants::MESSAGE_PLAYER_MOVE
        ]);
        Gateway::sendToAll($msg, null, $exclude_client_id);
    }

    public static function entityRemove($entity)
    {
        $msg = json_encode([
            'data'    => ['id' => $entity->id],
            'action'  => Constants::MESSAGE_ENTITY_REMOVE
        ]);
        Gateway::sendToAll($msg);
    }

    public static function entityCreate($entitys = [], $exclude_current = false)
    {
        if (!$entitys){ return; }
        foreach ($entitys as $entity) {
            $data_entitys[] = $entity->toArray();
        }

        $msg = json_encode([
            'data'    => ['entities' => $data_entitys],
            'action'  => Constants::MESSAGE_ENTITY_CREATE
        ]);
        $exclude_client_id = $exclude_current ? [$_SERVER['GATEWAY_CLIENT_ID']] : [];
        Gateway::sendToAll($msg, null,  $exclude_client_id);
    }

    public static function mapRefreshToClient($client_id, $gameInfo)
    {
        $msg = json_encode([
            'data'    => ['games' => $gameInfo],
            'action'  => Constants::MESSAGE_MAP_REFRESH
        ]);
        Gateway::sendToClient($client_id, $msg);
    }



}