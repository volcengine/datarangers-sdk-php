<?php
/*
 * Copyright 2020 Beijing Volcano Engine Technology Co., Ltd.
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 */

namespace DataRangers;


interface Collector
{
    /**
     * @param $userUniqueId string uuid
     * @param $appId int appid
     * @param $custom array 自定义属性
     * @param $eventName object 事件名,可以为array
     * @param $eventParams object 事件参数,可以为array,与$eventName 长度相同
     * 例如 $eventName $eventParams 分别为
     * $eventName = "launch" $eventParams = ["param1"=>"param1","param2"=>"param2"]
     * $eventName = ["launch1","launch2"] $eventParams = [["param1"=>"param1","param2"=>"param2"],["param3"=>"param3","param4"=>"param4"]]
     */
    public function sendEvent($userUniqueId, $appId, $custom, $eventName, $eventParams);

    /**
     * set user profile
     * @param $userUniqueId string
     * @param $appId int
     * @param $eventParams array set profile example ["php_version"=>"1.3.0"]
     * @return mixed
     */
    public function profileSet($userUniqueId, $appId, $eventParams);

    /**
     * @param $userUniqueId string
     * @param $appId int
     * @param $eventParams array unset profile example ["php_version"=>""]. unset php_version
     * @return mixed
     */
    public function profileUnset($userUniqueId, $appId, $eventParams);

    /**
     * @param $userUniqueId string
     * @param $appId int
     * @param $eventParams array set once profile example ["php_version"=>"1.1"]. set php_version only once
     * @return mixed
     */
    public function profileSetOnce($userUniqueId, $appId, $eventParams);

    /**
     * @param $userUniqueId string
     * @param $appId int
     * @param $eventParams array increment profile example ["php_example"=>10]. php_example=php_example+10
     * @return mixed
     */
    public function profileIncrement($userUniqueId, $appId, $eventParams);

    /**
     * @param $userUniqueId string
     * @param $appId int
     * @param $eventParams array append profile example ["php_version"=>["1.1","1.2"]]. append php_version
     * @return mixed
     */
    public function profileAppend($userUniqueId, $appId, $eventParams);

    public function itemSet($appId, $items);
    public function itemUnset($appId, $items);
    public function itemDelete($appId, $items);
}