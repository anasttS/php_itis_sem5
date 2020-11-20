<?php
include 'FileHandler.php';

if (isset($_POST['send'])) {
    $handler = new FileHandler('file');
    $string = $_POST['name'] . ": " . $_POST['string'] . "\n\n";
    $handler->writeString($string);
} else {
    include "form.html";
}
