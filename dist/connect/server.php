<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use ChatApp\Chat;

    require dirname(__DIR__) . '/vendor/autoload.php';
    require ("connect_db.php");
    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Chat($connect_db)
            )
        ),
        8080
    );

    $server->run();
?>