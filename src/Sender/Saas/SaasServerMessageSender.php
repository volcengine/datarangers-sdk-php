<?php

namespace DataRangers\Sender\Saas;

use DataRangers\CollectorConfig;
use DataRangers\Model\Message\Message;
use DataRangers\Model\Message\Saas\SaasServerAppMessage;
use DataRangers\Model\Util\HttpRequests;
use DataRangers\Sender\MessageSender;

class SaasServerMessageSender implements MessageSender
{
    private static string $path = "/v2/event/json";

    public function send(Message $message): void
    {
        $sendMessage = new SaasServerAppMessage($message);
        $url = CollectorConfig::getDOMAIN() . SaasServerMessageSender::$path;
        $header = CollectorConfig::getSendHeader();
        $app_id = $message->getAppMessage()->getAppId();
        $app_key = CollectorConfig::getAppKeys()[$app_id];
        if (!$app_key) {
            throw new \InvalidArgumentException("App key cannot be empty. app_id: " . $app_id);
        }
        $header['X-MCS-AppKey'] = $app_key;
        HttpRequests::doRequest("POST", $url, $header, null, $sendMessage, CollectorConfig::getHttpTimeout());
    }
}