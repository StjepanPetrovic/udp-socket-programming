<?php

declare(strict_types=1);

require 'UdpSocket.php';

final class Server extends UdpSocket
{
    public function __invoke()
    {
        while (true) {
            [$clientMessage, $clientIpAddr, $clientPort] = $this->receiveDataFrom();

            echo "Message from $clientIpAddr:$clientPort: $clientMessage\n\n";

            do {
                $message = readline('Write message: ');
            } while (!$message);

            $this->sendDataTo($clientIpAddr, $clientPort, $message);

            echo "Message sent to $clientIpAddr:$clientPort\n\n";
        }
    }
}

$server = new Server('127.0.0.1', 1111);
$server();
