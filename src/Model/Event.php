<?php
/*
 * Copyright 2020 Beijing Volcano Engine Technology Co., Ltd.
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 */

namespace DataRangers\Model;


class Event implements \JsonSerializable
{
    private $event;
    private $params;
    private $sessionId;
    private $localTimeMs;
    private $dateTime;
    private $userId;
    private $abSdkVersion;
    private $items;

    /**
     * Event constructor.
     */
    public function __construct($userId)
    {
        $this->localTimeMs = (int)(microtime(true) * 1000);
        $this->dateTime = date("Y-m-d H:i:s", time());
        $this->userId = $userId;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @param mixed $sessionId
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @param mixed $localTimeMs
     */
    public function setLocalTimeMs($localTimeMs)
    {
        $this->localTimeMs = $localTimeMs;
    }

    /**
     * @param mixed $dateTime
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @return int
     */
    public function getLocalTimeMs(): int
    {
        return $this->localTimeMs;
    }

    /**
     * @return false|string
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getAbSdkVersion()
    {
        return $this->abSdkVersion;
    }

    /**
     * @param mixed $abSdkVersion
     */
    public function setAbSdkVersion($abSdkVersion): void
    {
        $this->abSdkVersion = $abSdkVersion;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed items
     */
    public function setItems($items): void
    {
        $this->items = $items;
    }

    public function jsonSerialize()
    {
        $data = [];
        if ($this->event != null) $data["event"] = $this->event;
        if ($this->params != null) $data["params"] = $this->params;
        if ($this->localTimeMs != null) $data["local_time_ms"] = $this->localTimeMs;
        if ($this->userId != null) $data["user_id"] = $this->userId;
        if ($this->dateTime != null) $data["datetime"] = $this->dateTime;
        if ($this->abSdkVersion != null) $data["ab_sdk_version"] = $this->abSdkVersion;
        if ($this->items != null) {
            $data["params"]['__items'] = array_values($this->items);
        }
        return $data;
    }
}