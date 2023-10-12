<?php

declare(strict_types=1);

final class UdpServer
{
    private $socket;

    public function __construct(string $serverIpAddr, int $serverPort)
    {
        if (!$this->socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP)) {
            $this->echoErrorAndExit();
        }

        $this->bind($serverIpAddr, $serverPort);
    }

    public function __invoke()
    {
        while (true) {
            $clientIpAddr = '';
            $clientPort = 0;

            if (!$data = $this->receiveDataFrom($clientIpAddr, $clientPort)) {
                $this->echoErrorAndExit();
            }

            echo "Received $data from $clientIpAddr:$clientPort\n";

            if (!$this->sendDataTo($clientIpAddr, $clientPort)) {
                $this->echoErrorAndExit();
            }

            echo "Sent OK to $clientIpAddr:$clientPort\n";

            if (!$this->receiveDataFrom($clientIpAddr, $clientPort)) {
                $this->echoErrorAndExit();
            }

            echo "Sent OK to $clientIpAddr:$clientPort\n";
        }
    }

    private function bind(string $serverIpAddr, int $serverPort): void
    {
        if (!socket_bind($this->socket, $serverIpAddr, $serverPort)) {
            $this->echoErrorAndExit();
        }

        echo "Server is listening on $serverIpAddr:$serverPort\n";
    }

    private function receiveDataFrom(string $clientIpAddr, int $clientPort): int|false
    {
        return socket_recvfrom($this->socket, $data, 1024, 0, $clientIpAddr, $clientPort);
    }

    private function sendDataTo(string $clientIpAddr, int $clientPort): int|false
    {
        return socket_sendto($this->socket, "OK\n", 3, 0, $clientIpAddr, $clientPort);
    }

    private function echoErrorAndExit(): void
    {
        echo "Error: " . socket_strerror(socket_last_error($this->socket)) . "\n";

        exit(1);
    }
}

$server = new UdpServer('0.0.0.0', 1234);
$server();
