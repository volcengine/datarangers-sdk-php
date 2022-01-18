<?php

namespace DataRangers\Sender;

use DataRangers\CollectorConfig;
use DataRangers\Model\Message\Message;
use DataRangers\Model\Util\HttpRequests;

class PrivatizationMessageSender implements MessageSender
{

    public function send(Message $message): void
    {
        $appMessage = $message->getAppMessage();
        HttpRequests::doRequest("POST", CollectorConfig::getURL(), CollectorConfig::getSendHeader(), null, $appMessage, CollectorConfig::getHttpTimeout());
    }
}