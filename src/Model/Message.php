<?php
/*
 * Copyright 2020 Beijing Volcano Engine Technology Co., Ltd.
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 */

namespace DataRangers\Model;
use DataRangers\Model\Util\Constants;

class Message implements \JsonSerializable
{
    private $app_type;
    private $format_name;
    private $client_ip;
    private $trace_id;
    private $app_id;
    private $header;
    private $user_unique_id;
    private $event_v3;

    /**
     * Message constructor.
     */
    public function __construct()
    {
        $this->format_name = Constants::$SDK_VERSION;
    }


    /**
     * @param mixed $app_type
     */
    public function setAppType($app_type)
    {
        $this->app_type = $app_type;
    }

    /**
     * @param mixed $format_name
     */
    public function setFormatName($format_name)
    {
        $this->format_name = $format_name;
    }

    /**
     * @param mixed $client_ip
     */
    public function setClientIp($client_ip)
    {
        $this->client_ip = $client_ip;
    }

    /**
     * @param mixed $trace_id
     */
    public function setTraceId($trace_id)
    {
        $this->trace_id = $trace_id;
    }

    /**
     * @param mixed $app_id
     */
    public function setAppId($app_id)
    {
        $this->app_id = $app_id;
    }

    /**
     * @param mixed $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * @param mixed $user_unique_id
     */
    public function setUserUniqueId($user_unique_id)
    {
        $this->user_unique_id = $user_unique_id;
    }

    /**
     * @param mixed $event_v3
     */
    public function setEventV3($event_v3)
    {
        $this->event_v3 = $event_v3;
    }

    public function jsonSerialize()
    {
        $data = [];
        if ($this->app_type != null) $data["app_type"] = $this->app_type;
        if ($this->format_name != null) $data["format_name"] = $this->format_name;
        if ($this->client_ip != null) $data["client_ip"] = $this->client_ip;
        if ($this->trace_id != null) $data["trace_id"] = $this->trace_id;
        if ($this->app_id != null) $data["app_id"] = $this->app_id;
        if ($this->header != null) $data["header"] = $this->header;
        if ($this->user_unique_id != null) $data["user_unique_id"] = $this->user_unique_id;
        if ($this->event_v3 != null) $data["event_v3"] = $this->event_v3;
        return $data;
    }
}