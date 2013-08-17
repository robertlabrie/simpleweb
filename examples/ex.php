<?php
require_once __DIR__."/../vendor/autoload.php";

try {
	throw new SimpleWeb\SimpleWebException("The exception.",null,null,404,"HTTP_NOT_FOUND");
}
catch (SimpleWebException $ex)
{
	echo "\ndojo\n";
}
