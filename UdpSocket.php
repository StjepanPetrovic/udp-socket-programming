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

    public function __destruct()
    {
        socket_close($this->socket);
    }

    private function bind(string $serverIpAddr, int $serverPort): void
    {
        if (!socket_bind($this->socket, $serverIpAddr, $serverPort)) {
            $this->echoErrorAndExit();
        }

        echo "Server is listening on $serverIpAddr:$serverPort\n\n";
    }

    protected function receiveDataFrom(): array
    {
        if (!socket_recvfrom($this->socket, $data, 1024, 0, $clientIpAddr, $clientPort)) {
            $this->echoErrorAndExit();
        }

        return [$data, $clientIpAddr, $clientPort];
    }

    protected function sendDataTo(string $clientIpAddr, int $clientPort, string $data): void
    {
        if (!socket_sendto($this->socket, $data, 1024, 0, $clientIpAddr, $clientPort)) {
            $this->echoErrorAndExit();
        }
    }

    protected function echoErrorAndExit(): void
    {
        echo "Error: " . socket_strerror(socket_last_error($this->socket)) . "\n";

        exit(1);
    }
}
