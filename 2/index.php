<?php
include "book.html";
require "/home/anastt/PhpstormProjects/php_itis_5sem/vendor/predis/predis/autoload.php";
Predis\Autoloader::register();

try {
    $redis = new Predis\Client(array(
    "scheme" => "tcp",
    "host" => "127.0.0.1",
    "port" => 6379
    ));
}
catch (Exception $e) {
    die($e->getMessage());
}
if (isset($_REQUEST['send'])) {
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $redis->rpush("names", $name);
    $redis->rpush("comments", $comment);
}

if (isset($_REQUEST['show'])) {
    echo "<p><h1>All comments</h1></p>";
    $names = [];
    $comments = [];
    $names = $redis->lrange("names", 0, -1);
    $comments = $redis->lrange("comments", 0, -1);
    for ($i = 0; $i < count($names); $i++) {
        echo "<p>" . $names[$i] . ": " . $comments[$i] . "</p>";
        echo "<br />";
    }

//    $agent = 'user-agent: Chrome';
//    $data = array('names' => $names, 'comments' => $comments);
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8080/book.php");
//    curl_setopt($ch, CURLOPT_POST, 1);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
//    curl_exec($ch);
//    curl_close($ch);
}
