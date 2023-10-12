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

while (true) {
    $clientIpAddr = '';
    $clientPort = 0;

    if (socket_recvfrom($socket, $data, 1024, 0, $clientIpAddr, $clientPort)) {
        echo "Received $data from $clientIpAddr:$clientPort\n";
        if (socket_sendto($socket, "OK\n", 3, 0, $clientIpAddr, $clientPort)) {
            echo "Sent OK to $clientIpAddr:$clientPort\n";
        } else {
            echo "Error: " . socket_strerror(socket_last_error($socket)) . "\n";
            exit(1);
        }
    } else {
        echo "Error: " . socket_strerror(socket_last_error($socket)) . "\n";
        exit(1);
    }
}
