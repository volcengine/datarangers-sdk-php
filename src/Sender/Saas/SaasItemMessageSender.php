<?php

namespace DataRangers\Sender\Saas;

use DataRangers\CollectorConfig;
use DataRangers\Model\Event;
use DataRangers\Model\Message\Message;
use DataRangers\Model\Message\Saas\SaasItemAppMessage;
use DataRangers\Model\Util\AuthUtils;
use DataRangers\Model\Util\HttpRequests;
use DataRangers\Sender\MessageSender;

class SaasItemMessageSender implements MessageSender
{
    private static string $path = "/dataprofile/openapi/v1/%s/items/%s/%s/attributes";

    public function send(Message $message)
    {
        $appMessage = $message->getAppMessage();
        $events = $appMessage->getEventV3();
        $openapi = CollectorConfig::getOpenapi();
        $content = json_encode(array(
            "code" => "200",
            "message" => "success"
        ), JSON_PRESERVE_ZERO_FRACTION);
        foreach ($events as $event) {
            /** @var Event $event */
            $objectEvent = $event;
            $params = $objectEvent->getParams();
            $item_id = $params['item_id'];
            $item_name = $params['item_name'];
            $sendMessage = new SaasItemAppMessage($objectEvent);
            $urlPath = sprintf(SaasItemMessageSender::$path, $appMessage->getAppId(), $item_name, $item_id);
            $url = ($openapi->getDomain()) . $urlPath;
            $body = json_encode($sendMessage, JSON_PRESERVE_ZERO_FRACTION);
            $method = "PUT";

            $authorization = AuthUtils::sign($openapi->getAk(), $openapi->getSk(), 1800, $method, $urlPath, null, $body);

            $headers = CollectorConfig::getSendHeader();
            $headers["Authorization"] = $authorization;
            $content = HttpRequests::doRequest($method, $url, $headers, null, $body, CollectorConfig::getHttpTimeout());
        }
        return $content;
    }
}