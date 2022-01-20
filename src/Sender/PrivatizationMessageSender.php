<?php

namespace DataRangers\Sender;

use DataRangers\CollectorConfig;
use DataRangers\Model\Message\Message;
use DataRangers\Model\Util\HttpRequests;

class PrivatizationMessageSender implements MessageSender
{

    public function send(Message $message)
    {
        $appMessage = $message->getAppMessage();
        return HttpRequests::doRequest("POST", CollectorConfig::getURL(), CollectorConfig::getSendHeader(), null, $appMessage, CollectorConfig::getHttpTimeout());
    }
}