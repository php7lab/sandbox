<?php

namespace PhpLab\Sandbox\Socket\Domain\Libs;

use PhpLab\Core\Domain\Helpers\EntityHelper;
use PhpLab\Sandbox\Socket\Domain\Entities\SocketEventEntity;
use PhpLab\Sandbox\Socket\Domain\Enums\SocketEventEnum;
use PhpLab\Sandbox\Socket\Domain\Enums\SocketEventStatusEnum;
use Symfony\Component\Console\Application;
use PhpLab\Core\Libs\Env\DotEnvHelper;
use Illuminate\Container\Container;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Workerman\Connection\ConnectionInterface;
use Workerman\Worker;

class SocketDaemon {

    private $users = [];
    private $tcpWorker;
    private $wsWorker;
    private $localUrl = 'tcp://127.0.0.1:1234';

    public function __construct()
    {
        // массив для связи соединения пользователя и необходимого нам параметра
        $this->users = [];

        // создаём ws-сервер, к которому будут подключаться все наши пользователи
        $this->wsWorker = new Worker("websocket://0.0.0.0:8001");
        // создаём обработчик, который будет выполняться при запуске ws-сервера
        $this->wsWorker->onWorkerStart = function()
        {
            // создаём локальный tcp-сервер, чтобы отправлять на него сообщения из кода нашего сайта
            $this->tcpWorker = new Worker($this->localUrl);
            // создаём обработчик сообщений, который будет срабатывать,
            // когда на локальный tcp-сокет приходит сообщение
            $this->tcpWorker->onMessage = function($connection, $data) {
                /** @var SocketEventEntity $eventEntity */
                $eventEntity = unserialize($data);
                $userId = intval($eventEntity->getUserId());
                // отправляем сообщение пользователю по userId
                if (isset($this->users[$userId])) {
                    $webconnection = $this->users[$userId];
                    $this->send($eventEntity, $webconnection);
                }
            };
            $this->tcpWorker->listen();
        };

        $this->wsWorker->onConnect = function($connection)
        {
            $connection->onWebSocketConnect = function($connection)
            {
                $userId = intval($_GET['userId']);
                if(empty($userId)) {
                    throw new Exception('Empty user id;');
                }
                // при подключении нового пользователя сохраняем get-параметр, который же сами и передали со страницы сайта
                $this->users[$userId] = $connection;
                // вместо get-параметра можно также использовать параметр из cookie, например $_COOKIE['PHPSESSID']

                $event = new SocketEventEntity;
                $event->setUserId($userId);
                $event->setName(SocketEventEnum::CONNECT);
                $this->send($event, $connection);
            };
        };

        $this->wsWorker->onClose = function($connection)
        {
            // удаляем параметр при отключении пользователя
            $user = array_search($connection, $this->users);
            unset($this->users[$user]);

            $event = new SocketEventEntity;
            $event->setName(SocketEventEnum::DISCONNECT);
            $this->send($event, $connection);
        };

    }

    public function sendMessageToTcp(SocketEventEntity $eventEntity) {
        // соединяемся с локальным tcp-сервером
        $instance = stream_socket_client($this->localUrl);
        $serialized = serialize($eventEntity);
        // отправляем сообщение
        fwrite($instance, $serialized . "\n");
    }

    public function onWsStart(ConnectionInterface $connection) {

    }

    public function onWsConnect(ConnectionInterface $connection) {

    }

    public function onWsClose(ConnectionInterface $connection) {

    }

    public function onTcpMessage(ConnectionInterface $connection) {

    }

    public function runAll() {
        // Run worker
        Worker::runAll();
    }

    private function send(SocketEventEntity $socketEventEntity, ConnectionInterface $connection) {
        $eventArray = EntityHelper::toArray($socketEventEntity);
        $json = json_encode($eventArray);
        $connection->send($json);
    }

}