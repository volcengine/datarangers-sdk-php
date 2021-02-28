<?php
/*
 * Copyright 2020 Beijing Volcano Engine Technology Co., Ltd.
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 */

namespace DataRangers;

use DataRangers\Model\Util\Constants;
use DataRangers\Model\Util\HttpRequests;

class HttpConsumer extends AbstractConsumer
{
    public function send($message)
    {
        if (!CollectorConfig::isOk()) throw new RangersSDKException(Constants::$INIT_EXCEPTION);
        if (CollectorConfig::isSend()) {
            return HttpRequests::doRequest("POST", CollectorConfig::getURL(), CollectorConfig::getSendHeader(), null, $message, CollectorConfig::getHttpTimeout());
        }
        return "please enable send mode";
    }
}