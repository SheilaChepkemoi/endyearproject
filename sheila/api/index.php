<?php

use Jowath\APIHandler;

require_once "./src/Jowath/APIHandler.php";

$data = file_get_contents("php://input");

$api = new APIHandler();
$api->makeAPICall($data);