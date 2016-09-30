<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;

use Server\Player;
use Server\Message;
use Server\Constants;


/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events
{

    static $gameServer;

    public static function onWorkerStart()
    {
        static::$gameServer = new Server\GameServer; 
    }

    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     * 
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id) {
        if (method_exists(static::$gameServer, 'onConnect'))
        {
          static::$gameServer->onConnect($client_id);
        }
    }
    
   /**
    * 当客户端发来消息时触发
    * @param int $client_id 连接id
    * @param mixed $message 具体消息
    */
   public static function onMessage($client_id, $message) {
        // 向所有人发送 
        $msg = json_decode($message, true);
        if (!$msg) return;

        $action = $msg['action'];
        $data   = $msg['data'];
        // print_r($msg);
        switch ($action) {
          case Constants::MESSAGE_PLAYER_JOIN:
              // 检查用户player情况
            if (!$_SESSION['player']){
              $_SESSION['player'] = static::$gameServer->createNewPlayer($client_id, $data['nick']);
            }
            break;
          case Constants::MESSAGE_PLAYER_MOVE:
            static::$gameServer->onClientGamerMove($client_id, $data['id'], $data['pos']);
            break;
          case Constants::MESSAGE_ENTITY_CRASH:
            break;
          default:
            # code...
            break;
        }


   }
   
   /**
    * 当用户断开连接时触发
    * @param int $client_id 连接id
    */
   public static function onClose($client_id) {
      static::$gameServer->onClientLeave($client_id);
   }
}
