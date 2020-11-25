<?php
include "main_guests_page.html";

$names = $_POST['names'];
$comments = $_POST['comments'];
for ($i = 0; $i < count($names); $i++) {
    echo "<p>" . $names[$i] . ": " . $comments[$i] . "</p>";
    echo "<br />";
}

