<?php

declare(strict_types=1);

$socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

$serverIpAddr = '0.0.0.0';
$serverPort = 1234;

if (socket_bind($socket, $serverIpAddr, $serverPort)) {
    echo "Server is listening on $serverIpAddr:$serverPort\n";
} else {
    echo "Error: " . socket_strerror(socket_last_error($socket)) . "\n";
    exit(1);
}
