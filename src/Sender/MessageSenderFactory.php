<?php

namespace DataRangers\Sender;

use DataRangers\Model\Event;
use DataRangers\Model\Message\Message;
use DataRangers\Model\Message\MessageEnv;
use DataRangers\Model\Message\MessageType;
use DataRangers\Sender\Saas\SaasItemMessageSender;
use DataRangers\Sender\Saas\SaasProfileMessageSender;
use DataRangers\Sender\Saas\SaasServerMessageSender;

class MessageSenderFactory
{
    private function __construct()
    {
    }

    public static function getMessageSender(Message $message): MessageSender
    {
        $env = $message->getMessageEnv();
        if ($env !== MessageEnv::SAAS) {
            return new PrivatizationMessageSender();
        }
        $messageType = $message->getMessageType();
        switch ($messageType) {
            case MessageType::EVENT:
                return new SaasServerMessageSender();
            case MessageType::PROFILE:
                return new SaasProfileMessageSender();
            case MessageType::ITEM:
                return new SaasItemMessageSender();
            default:
                throw new \InvalidArgumentException("Not support message type: " . $messageType);
        }
    }
}