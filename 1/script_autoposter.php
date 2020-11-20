<?php
$agent = 'user-agent: Chrome';
$data = array('name' => 'Nastya', 'string' => 'Hello!');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8080");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
$response = curl_exec($ch);
curl_close($ch);
var_dump($response);