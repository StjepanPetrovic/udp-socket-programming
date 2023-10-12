<?php

declare(strict_types=1);

abstract class UdpSocket
{
    private $socket;

    public function __construct(string $serverIpAddr, int $serverPort)
    {
        if (!$this->socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP)) {
            $this->echoErrorAndExit();
        }

        $this->bind($serverIpAddr, $serverPort);
    }

    private function bind(string $serverIpAddr, int $serverPort): void
    {
        if (!socket_bind($this->socket, $serverIpAddr, $serverPort)) {
            $this->echoErrorAndExit();
        }

        echo "Server is listening on $serverIpAddr:$serverPort\n";
    }

    protected function receiveDataFrom(string $clientIpAddr, int $clientPort): int|false
    {
        return socket_recvfrom($this->socket, $data, 1024, 0, $clientIpAddr, $clientPort);
    }

    protected function sendDataTo(string $clientIpAddr, int $clientPort): int|false
    {
        return socket_sendto($this->socket, "OK\n", 3, 0, $clientIpAddr, $clientPort);
    }

    protected function echoErrorAndExit(): void
    {
        echo "Error: " . socket_strerror(socket_last_error($this->socket)) . "\n";

        exit(1);
    }
}
