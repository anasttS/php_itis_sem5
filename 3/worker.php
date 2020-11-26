<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('task_queue', false, true, false, false);

echo " Waiting for messages\n";

$callback = function ($msg) {
    echo ' Received ', $msg->body, "\n";
    $handler = fopen("". $msg->body."",'x');
    fwrite($handler,$msg->body." ");
    fclose($handler);
    echo " Done\n";
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('task_queue', '', false, false, false, false, $callback);

while ($channel->is_consuming()) {
    try {
        $channel->wait();
    } catch (ErrorException $e) {
    }
}

$channel->close();
try {
    $connection->close();
} catch (Exception $e) {
}