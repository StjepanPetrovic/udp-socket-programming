<?php

declare(strict_types=1);

require 'UdpSocket.php';

final class Client extends UdpSocket
{
    public function __invoke()
    {
        while (true) {
            $serverIpAddr = '127.0.0.1';
            $serverPort = 1111;

            do {
                $message = readline('Write message: ');
            } while (!$message);

            $this->sendDataTo($serverIpAddr, $serverPort, $message);

            echo "Message sent to $serverIpAddr:$serverPort\n\n";

            [$serverMessage, $serverIpAddr, $serverPort] = $this->receiveDataFrom();

            echo "Message from $serverIpAddr:$serverPort:$serverMessage\n\n";
        }
    }
}

$client = new Client('127.0.0.1', 2222);
$client();
