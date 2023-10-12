<?php

declare(strict_types=1);

require 'UdpSocket.php';

final class Client extends UdpSocket
{
    public function __invoke()
    {
        while (true) {
            $serverIpAddr = '0.0.0.0';
            $serverPort = 1234;

            if (!$this->sendDataTo($serverIpAddr, $serverPort)) {
                $this->echoErrorAndExit();
            }

            echo "Sent OK to $serverIpAddr:$serverPort\n";

            if (!$data = $this->receiveDataFrom($serverIpAddr, $serverPort)) {
                $this->echoErrorAndExit();
            }

            echo "Received $data from $serverIpAddr:$serverPort\n";
        }
    }
}

$client = new Client('0.0.0.0', 2345);
$client();
