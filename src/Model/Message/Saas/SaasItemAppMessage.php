<?php
namespace DataRangers\Model\Message\Saas;

use DataRangers\Model\Event;
use DataRangers\Model\ItemMethod;
use DataRangers\Model\Message\Message;

class SaasItemAppMessage extends SaasProfileAppMessage
{
    private static array $operationMap = array(
        ItemMethod::SET => "SET",
        ItemMethod::UN_SET => "UNSET",
        ItemMethod::DELETE => "DELETE"
    );

    public function __construct(Event $event)
    {
        $params = $event->getParams();
        if (is_array($params) && (!empty($params))) {
            foreach ($params as $key => $value) {
                if ("item_id" === $key || "item_name" === $key) {
                    continue;
                }
                $event_name = $event->getEvent();
                $this->addAttribution($key, $value, $event_name);
            }
        }
    }

    protected function operationConvert(string $method): string
    {
        return SaasItemAppMessage::$operationMap[$method];
    }
}