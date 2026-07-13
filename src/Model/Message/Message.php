<?php
/*
 * Copyright 2020 Beijing Volcano Engine Technology Co., Ltd.
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 */

namespace DataRangers\Model\Message;

class Message
{
    private $messageEnv;
    private $messageType;
    private $appMessage;

    /**
     * @return mixed
     */
    public function getMessageEnv()
    {
        return $this->messageEnv;
    }

    /**
     * @param mixed $messageEnv
     */
    public function setMessageEnv($messageEnv): void
    {
        $this->messageEnv = $messageEnv;
    }

    /**
     * @return mixed
     */
    public function getMessageType()
    {
        return $this->messageType;
    }

    /**
     * @param mixed $messageType
     */
    public function setMessageType($messageType): void
    {
        $this->messageType = $messageType;
    }

    /**
     * @return AppMessage
     */
    public function getAppMessage(): AppMessage
    {
        return $this->appMessage;
    }

    /**
     * @param AppMessage $appMessage
     */
    public function setAppMessage(AppMessage $appMessage): void
    {
        $this->appMessage = $appMessage;
    }


}