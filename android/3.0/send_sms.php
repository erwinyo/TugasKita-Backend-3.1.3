<?php
    include "vendor/autoload.php";

    $clients = new SMSGatewayMe\Client\ClientProvider("your-token-here");

    $sendMessageRequest = new SMSGatewayMe\Client\Model\SendMessageRequest([
        'phoneNumber' => '07791064782', 'message' => 'hello world', 'deviceId' => 1
    ]);

    $sentMessages = $clients->getMessageClient()->sendMessages([$sendMessageRequest]);
                            