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
    private $session_id;
    private $local_time_ms;
    private $datetime;
    private $user_id;
    private $items;

    /**
     * Event constructor.
     */
    public function __construct($user_id)
    {
        $this->local_time_ms = (int)(microtime(true) * 1000);
        $this->datetime = date("Y-m-d H:i:s", time());
        $this->user_id = $user_id;
        $this->items = [];
        $this->params = [];
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event): void
    {
        $this->event = $event;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params): void
    {
        if (is_array($params)) {
            foreach ($params as $key => $value) {
                $this->addParams($key, $value);
            }
        }
    }

    public function addParams($key, $value): void
    {
        if ($key == "items" && is_array($value)) {
            foreach ($value as $index => $item_part) {
                if (is_array($item_part)&&array_key_exists("item_id", $item_part) && array_key_exists("item_name", $item_part)) {
                    if (!array_key_exists($item_part["item_name"], $this->items)) {
                        $this->items[$item_part["item_name"]] = [];
                    }
                    $this->items[$item_part["item_name"]][] = $item_part["item_id"];
                }
            }
        } else {
            $this->params[$key] = $value;
        }
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->session_id;
    }

    /**
     * @param mixed $session_id
     */
    public function setSessionId($session_id): void
    {
        $this->session_id = $session_id;
    }

    /**
     * @return int
     */
    public function getLocalTimeMs(): int
    {
        return $this->local_time_ms;
    }

    /**
     * @param int $local_time_ms
     */
    public function setLocalTimeMs(int $local_time_ms): void
    {
        $this->local_time_ms = $local_time_ms;
    }

    /**
     * @return false|string
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param false|string $datetime
     */
    public function setDatetime($datetime): void
    {
        $this->datetime = $datetime;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    public function jsonSerialize()
    {
        $data = [];
        if ($this->event != null) $data["event"] = $this->event;
        if (count($this->items) > 0) {
            $item_params = [];
            foreach ($this->items as $key => $value) {
                $item_params[$key] = [];
                foreach ($value as $index => $v) {
                    $item_params[$key][] = ["id" => $v];
                }
            }
            $this->params["__items"] = $item_params;
        }
        if ($this->params != null) $data["params"] = $this->params;
        if ($this->local_time_ms != null) $data["local_time_ms"] = $this->local_time_ms;
        if ($this->user_id != null) $data["user_id"] = $this->user_id;
        if ($this->datetime != null) $data["datetime"] = $this->datetime;
        return $data;
    }
}