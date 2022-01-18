<?php

namespace DataRangers\Model\Message\Saas;

use DataRangers\Model\Event;
use DataRangers\Model\Message\Message;
use DataRangers\Model\ProfileMethod;

class SaasProfileAppMessage implements \JsonSerializable
{
    private static array $operationMap = array(
        ProfileMethod::SET => "SET",
        ProfileMethod::SET_ONCE => "SET_ONCE",
        ProfileMethod::APPEND => "APPEND",
        ProfileMethod::INCREMENT => "INCREMENT",
        ProfileMethod::UN_SET => "UNSET"
    );

    private array $attributions;

    public function __construct(Message $message)
    {
        $appMessage = $message->getAppMessage();
        $events = $appMessage->getEventV3();
        foreach ($events as $event) {
            /** @var Event $event */
            $objectEvent = $event;
            $params = $objectEvent->getParams();
            if (is_array($params) && (!empty($params))) {
                foreach ($params as $key => $value) {
                    $event_name = $objectEvent->getEvent();
                    $this->addAttribution($key, $value, $event_name);
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getAttributions(): array
    {
        return $this->attributions;
    }

    /**
     * @param array $attributions
     */
    public function setAttributions(array $attributions): void
    {
        $this->attributions = $attributions;
    }


    protected function addAttribution(string $name, $value, string $method): void
    {
        $operation = $this->operationConvert($method);
        if ($operation == null) {
            throw new \InvalidArgumentException("Not support operation: " . $method);
        }
        $this->attributions[] = new Attribution($name, $value, $operation);
    }

    protected function operationConvert(string $method): string
    {
        return SaasProfileAppMessage::$operationMap[$method];
    }


    public function jsonSerialize()
    {
        $data = [];
        if (!empty($this->attributions)) {
            $data["attributes"] = array_values($this->attributions);
        }
        return $data;
    }
}