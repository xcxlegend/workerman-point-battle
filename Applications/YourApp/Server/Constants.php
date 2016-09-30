<?php 

namespace Server;

class Constants{

    // entity
    const MESSAGE_PLAYER_JOIN = 1; // 开始游戏
    const MESSAGE_PLAYER_DEAD = 2;  // 死亡
    const MESSAGE_PLAYER_MOVE = 3;  // 玩家移动

    const MESSAGE_ENTITY_CREATE = 4; // 添加一个对象
    const MESSAGE_ENTITY_REMOVE = 5; // 移除一个对象
    const MESSAGE_ENTITY_MOVE   = 6; // 对象移动
    const MESSAGE_ENTITY_CRASH  = 7; // 碰撞
    const MESSAGE_ENTITY_POS    = 8; // 对象重定位坐标

    const MESSAGE_MAP_REFRESH   = 9; // 地图刷新



    const ENTITY_TYPE_PLAYER = 100; 
    const ENTITY_TYPE_MOB = 101; 
    const ENTITY_TYPE_PROP = 102;


    const TOWARD_UP    = 1; 
    const TOWARD_DOWN  = -1; 
    const TOWARD_LEFT  = 2; 
    const TOWARD_RIGHT = -2; 

}