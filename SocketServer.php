<?php

declare(strict_types=1);

$socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

$serverIpAddr = '0.0.0.0';
$serverPort = 1234;

socket_bind($socket, $serverIpAddr, $serverPort);
