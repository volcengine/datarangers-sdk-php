<?php
/*
 * Copyright 2020 Beijing Volcano Engine Technology Co., Ltd.
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 */

namespace DataRangers\Model\Message;

use DataRangers\Model\Util\Constants;

class AppMessage implements \JsonSerializable
{
    private $appType;
    private $formatName;
    private $clientIp;
    private $traceId;
    private $appId;
    private $header;
    private $userUniqueId;
    private $eventV3;

    /**
     * Message constructor.
     */
    public function __construct()
    {
        $this->formatName = Constants::$SDK_VERSION;
    }


    /**
     * @param mixed $appType
     */
    public function setAppType($appType)
    {
        $this->appType = $appType;
    }

    /**
     * @param mixed $formatName
     */
    public function setFormatName($formatName)
    {
        $this->formatName = $formatName;
    }

    /**
     * @param mixed $clientIp
     */
    public function setClientIp($clientIp)
    {
        $this->clientIp = $clientIp;
    }

    /**
     * @param mixed $traceId
     */
    public function setTraceId($traceId)
    {
        $this->traceId = $traceId;
    }

    /**
     * @param mixed $appId
     */
    public function setAppId($appId)
    {
        $this->appId = $appId;
    }

    /**
     * @param mixed $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * @param mixed $userUniqueId
     */
    public function setUserUniqueId($userUniqueId)
    {
        $this->userUniqueId = $userUniqueId;
    }

    /**
     * @param mixed $eventV3
     */
    public function setEventV3($eventV3)
    {
        $this->eventV3 = $eventV3;
    }

    /**
     * @return mixed
     */
    public function getAppType()
    {
        return $this->appType;
    }

    /**
     * @return string
     */
    public function getFormatName(): string
    {
        return $this->formatName;
    }

    /**
     * @return mixed
     */
    public function getClientIp()
    {
        return $this->clientIp;
    }

    /**
     * @return mixed
     */
    public function getTraceId()
    {
        return $this->traceId;
    }

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @return mixed
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return mixed
     */
    public function getUserUniqueId()
    {
        return $this->userUniqueId;
    }

    /**
     * @return mixed
     */
    public function getEventV3()
    {
        return $this->eventV3;
    }

    public function jsonSerialize()
    {
        $data = [];
        if ($this->appType != null) $data["app_type"] = $this->appType;
        if ($this->formatName != null) $data["format_name"] = $this->formatName;
        if ($this->clientIp != null) $data["client_ip"] = $this->clientIp;
        if ($this->traceId != null) $data["trace_id"] = $this->traceId;
        if ($this->appId != null) $data["app_id"] = $this->appId;
        if ($this->header != null) $data["header"] = $this->header;
        if ($this->userUniqueId != null) $data["user_unique_id"] = $this->userUniqueId;
        if ($this->eventV3 != null) $data["event_v3"] = $this->eventV3;
        return $data;
    }

}