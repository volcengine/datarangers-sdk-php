<?php
/*
 * Copyright 2020 Beijing Volcano Engine Technology Co., Ltd.
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 */

namespace DataRangers;

use DataRangers\Model\Event;
use DataRangers\Model\EventWithItem;
use DataRangers\Model\Header;
use DataRangers\Model\ItemMethod;
use DataRangers\Model\Message\AppMessage;
use DataRangers\Model\Message\Message;
use DataRangers\Model\Message\MessageType;
use DataRangers\Model\ProfileMethod;
use DataRangers\Model\Util\Constants;

class EventCollector implements Collector
{
    public $consumer;
    public $appType;

    /**
     * EventCollector constructor.
     * @param $consumer
     */
    public function __construct($consumer, $appType)
    {
        $this->consumer = $consumer;
        $this->appType = $appType;
    }

    public function sendEvent($userUniqueId, $appId, $custom, $eventName, $eventParams, $items = [[]])
    {
        $header = new Header();
        $header->setAppId($appId);
        $header->setUserUniqueId($userUniqueId);
        if ($custom != null) $header->setCustom($custom);
        $events = [];
        if (is_array($eventName) && is_array($eventParams) && is_array($items)) {
            $events = array_map(function ($event_name, $event_params, $items) use ($userUniqueId) {
                $event = new Event($userUniqueId);
                $event->setEvent($event_name);
                $event->setParams($event_params);
                $this->setItemsWithEvent($items, $event);
                return $event;
            }, $eventName, $eventParams, $items);
        } else {
            $event = new Event($userUniqueId);
            $event->setEvent($eventName);
            $event->setParams($eventParams);
            $this->setItemsWithEvent($items, $event);
            $events[] = $event;
        }
        $message = new Message();
        $message->setMessageType(MessageType::EVENT);
        $message->setMessageEnv(CollectorConfig::getEnv());

        $appMessage = new AppMessage();
        $message->setAppMessage($appMessage);

        $appMessage->setUserUniqueId($userUniqueId);
        $appMessage->setEventV3($events);
        $appMessage->setAppId($appId);
        $appMessage->setAppType($this->appType);
        $appMessage->setHeader($header);

        $this->consumer->send($message);
    }

    public function profile($userUniqueId, $appId, $eventName, $eventParams)
    {
        $header = new Header();
        $header->setAppId($appId);
        $header->setUserUniqueId($userUniqueId);
        $events = [];
        $event = new Event($userUniqueId);
        $event->setEvent($eventName);
        $event->setParams($eventParams);
        $events[] = $event;

        $message = new Message();
        $message->setMessageType(MessageType::PROFILE);
        $message->setMessageEnv(CollectorConfig::getEnv());

        $appMessage = new AppMessage();
        $message->setAppMessage($appMessage);

        $appMessage->setUserUniqueId($userUniqueId);
        $appMessage->setEventV3($events);
        $appMessage->setAppId($appId);
        $appMessage->setAppType($this->appType);
        $appMessage->setHeader($header);

        $this->consumer->send($message);
    }

    public function profileSet($userUniqueId, $appId, $profileParams)
    {
        $this->profile($userUniqueId, $appId, ProfileMethod::SET, $profileParams);
    }


    public function __destruct()
    {
        if ($this->consumer != null) $this->consumer->close();
    }

    public function profileUnset($userUniqueId, $appId, $eventParams)
    {
        $this->profile($userUniqueId, $appId, ProfileMethod::UN_SET, $eventParams);
    }

    public function profileSetOnce($userUniqueId, $appId, $eventParams)
    {
        $this->profile($userUniqueId, $appId, ProfileMethod::SET_ONCE, $eventParams);
    }

    public function profileIncrement($userUniqueId, $appId, $eventParams)
    {
        $this->profile($userUniqueId, $appId, ProfileMethod::INCREMENT, $eventParams);
    }

    public function profileAppend($userUniqueId, $appId, $eventParams)
    {
        $this->profile($userUniqueId, $appId, ProfileMethod::APPEND, $eventParams);
    }

    public function itemSet($appId, $itemName, $itemId, $itemParams)
    {
        $this->item($appId, $itemName, $itemId, ItemMethod::SET, $itemParams);
    }

    public function itemUnset($appId, $itemName, $itemId, $itemParams)
    {
        $this->item($appId, $itemName, $itemId, ItemMethod::UN_SET, $itemParams);
    }

    public function itemDelete($appId, $itemName, $itemId, $itemParams)
    {
        $this->item($appId, $itemName, $itemId, ItemMethod::DELETE, $itemParams);
    }

    private function item($appId, $itemName, $itemId, $eventName, $itemParams)
    {
        $userUniqueId = Constants::$DEFAULT_ITEM_USER;
        $itemParams['item_id'] = $itemId;
        $itemParams['item_name'] = $itemName;

        $header = new Header();
        $header->setAppId($appId);
        $header->setUserUniqueId(Constants::$DEFAULT_ITEM_USER);
        $events = [];
        $event = new Event($userUniqueId);
        $event->setEvent($eventName);
        $event->setParams($itemParams);
        $events[] = $event;

        $message = new Message();
        $message->setMessageType(MessageType::ITEM);
        $message->setMessageEnv(CollectorConfig::getEnv());

        $appMessage = new AppMessage();
        $message->setAppMessage($appMessage);

        $appMessage->setUserUniqueId($userUniqueId);
        $appMessage->setEventV3($events);
        $appMessage->setAppId($appId);
        $appMessage->setAppType($this->appType);
        $appMessage->setHeader($header);

        $this->consumer->send($message);
    }

    /**
     * @param array $items
     * @return array
     */
    private function getEventWithItems(array $items): array
    {
        $eventWithItems = [];
        foreach ($items as $key => $value) {
            $eventWithItem = new EventWithItem();
            $eventWithItem->setItemName($key);
            $eventWithItem->setItemIds($value);
            $eventWithItems [] = $eventWithItem;
        }
        return $eventWithItems;
    }

    /**
     * @param $items
     * @param Event $event
     * @return void
     */
    public function setItemsWithEvent($items, Event $event): void
    {
        if (is_array($items) && (!empty($items))) {
            $eventWithItems = $this->getEventWithItems($items);
            $event->setItems($eventWithItems);
        }
    }
}