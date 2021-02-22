<?php
/*
 * Copyright 2020 Beijing Volcano Engine Technology Co., Ltd.
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 */

namespace DataRangers;

use DataRangers\Model\Event;
use DataRangers\Model\Header;
use DataRangers\Model\ItemsMethod;
use DataRangers\Model\Message;
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
        if ($consumer == null) {
            if (CollectorConfig::isSave()) {
                $consumer = new FileConsumer();
            } else {
                $consumer = new HttpConsumer();
            }
        }
        $this->consumer = $consumer;
        $this->appType = $appType;
    }

    public function sendEvent($userUniqueId, $appId, $custom, $eventName, $eventParams, $items = null)
    {
        $header = new Header();
        $header->setAppId($appId);
        $header->setUserUniqueId($userUniqueId);
        if ($custom != null) $header->setCustom($custom);
        return $this->sendUserDefineEvent($header, $userUniqueId, $appId, $custom, $eventName, $eventParams, $items);
    }

    public function sendUserDefineEvent($header, $userUniqueId, $appId, $custom, $eventName, $eventParams, $items = null)
    {
        $header->setAppId($appId);
        $header->setUserUniqueId($userUniqueId);
        $events = [];
        if (is_array($eventName) && is_array($eventParams)) {
            if ($items == null) $items = array();
            $events = array_map(function ($event_name, $event_params, $item) use ($userUniqueId) {
                $event = new Event($userUniqueId);
                $event->setEvent($event_name);
                $event->addItems($item);
                $event->setParams($event_params);
                return $event;
            }, $eventName, $eventParams, $items);
        } else {
            $event = new Event($userUniqueId);
            $event->setEvent($eventName);
            $event->addItems($items);
            $event->setParams($eventParams);
            $events[] = $event;
        }
        $message = new Message();
        $message->setUserUniqueId($userUniqueId);
        $message->setEventV3($events);
        $message->setAppId($appId);
        $message->setAppType($this->appType);
        $message->setHeader($header);
        return $this->consumer->send($message);
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
        $message->setUserUniqueId($userUniqueId);
        $message->setEventV3($events);
        $message->setAppId($appId);
        $message->setAppType($this->appType);
        $message->setHeader($header);
        $this->consumer->send($message);
    }

    public function profileSet($userUniqueId, $appId, $eventParams)
    {
        $this->profile($userUniqueId, $appId, ProfileMethod::SET, $eventParams);
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


    public function itemSet($appId, $itemName, $items)
    {
        $items["item_name"] = $itemName;
        $this->profile(Constants::$DEFAULT_USER, $appId, ItemsMethod::SET, $items);
    }

    public function itemUnset($appId, $itemName, $itemId, $items)
    {
        $item_params = ["item_id" => $itemId, "item_name" => $itemName];
        foreach ($items as $item) {
            $item_params[$item] = "php";
        }
        $this->profile(Constants::$DEFAULT_USER, $appId, ItemsMethod::UNSET, $item_params);
    }

    public function itemDelete($appId, $itemName, $items)
    {
        $this->profile(Constants::$DEFAULT_USER, $appId, ItemsMethod::DELETE, $items);
    }
}