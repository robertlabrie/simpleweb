<?php
require_once __DIR__."/../vendor/autoload.php";

$web = SimpleWeb\SimpleWeb::build("curl");

$data = $web->get("http://www.example.com/fonk");

echo $data;