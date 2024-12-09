<?php

namespace DataRangers\Sender\Saas;

use DataRangers\CollectorConfig;
use DataRangers\Model\Message\Message;
use DataRangers\Model\Message\Saas\SaasProfileAppMessage;
use DataRangers\Model\Util\AuthUtils;
use DataRangers\Model\Util\HttpRequests;
use DataRangers\Sender\MessageSender;

class SaasProfileMessageSender implements MessageSender
{
    private static string $path = "/dataprofile/openapi/v1/%s/users/%s/attributes";

    public function send(Message $message): void
    {
        $sendMessage = new SaasProfileAppMessage($message);
        $body = json_encode($sendMessage, JSON_PRESERVE_ZERO_FRACTION);
        $appMessage = $message->getAppMessage();
        $openapi = CollectorConfig::getOpenapi();
        $urlPath = sprintf(SaasProfileMessageSender::$path, $appMessage->getAppId(), $appMessage->getUserUniqueId());
        $url = ($openapi->getDomain()) . $urlPath;
        $method = "PUT";

        $authorization = AuthUtils::sign($openapi->getAk(), $openapi->getSk(), 1800, $method, $urlPath, null, $body);

        $headers = CollectorConfig::getSendHeader();
        $headers["Authorization"] = $authorization;
        HttpRequests::doRequest($method, $url, $headers, null, $body, CollectorConfig::getHttpTimeout());

    }
}