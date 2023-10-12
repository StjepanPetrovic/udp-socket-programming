<?php

declare(strict_types=1);

require 'UdpSocket.php';

final class Server extends UdpSocket
{
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
        }
    }
}

$server = new Server('0.0.0.0', 1234);
$server();
