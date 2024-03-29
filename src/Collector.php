<?php
/*
 * Copyright 2020 Beijing Volcano Engine Technology Co., Ltd.
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 */

namespace DataRangers;


use DataRangers\Model\Header;

interface Collector
{
    /**
     * @param $userUniqueId string uuid
     * @param $appId int appid
     * @param $custom array 自定义属性
     * @param $eventName object 事件名,可以为array。当为array的时候，表示多个事件，$eventParams 应该为[[]]。
     * @param $eventParams object 事件参数,为array,数组个数与$eventName 长度相同。
     * @param $items object item参数,可以为array,与$eventName 长度相同

     * 例如 $eventName $eventParams, $items 分别为
     * $eventName = "launch" $eventParams = ["param1"=>"param1","param2"=>"param2"]
     *
     * $eventName = ["launch1","launch2"]
     * $eventParams = [["param1"=>"param1","param2"=>"param2"],["param3"=>"param3","param4"=>"param4"]]
     * $items = [[
            ["item_id" => "0001", "item_name" => "book"],
            ["item_id" => "0002", "item_name" => "book"],
            ["item_id" => "0003", "item_name" => "phone"]
        ]];
     */
    public function sendEvent($userUniqueId, $appId, $custom, $eventName, $eventParams, $items=null, $abSdkVersion=null);

    public function sendUserDefineEvent($header,$userUniqueId, $appId, $custom, $eventName, $eventParams);

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


    /**
     * set user profile
     * @param $header Header
     * @param $eventParams array set profile example ["php_version"=>"1.3.0"]
     * @return mixed
     */
    public function profileSetWithHeader($header, $eventParams);

    /**
     * @param $header Header
     * @param $eventParams array unset profile example ["php_version"=>""]. unset php_version
     * @return mixed
     */
    public function profileUnsetWithHeader($header, $eventParams);

    /**
     * @param $header Header
     * @param $eventParams array set once profile example ["php_version"=>"1.1"]. set php_version only once
     * @return mixed
     */
    public function profileSetOnceWithHeader($header, $eventParams);

    /**
     * @param $header Header
     * @param $eventParams array increment profile example ["php_example"=>10]. php_example=php_example+10
     * @return mixed
     */
    public function profileIncrementWithHeader($header, $eventParams);

    /**
     * @param $header Header
     * @param $eventParams array append profile example ["php_version"=>["1.1","1.2"]]. append php_version
     * @return mixed
     */
    public function profileAppendWithHeader($header, $eventParams);

    /**
     * @param $appId int app id
     * @param $itemName string item name
     * @param $items array item example:[["item_id"=>"0001","item_name"=>"book","item_price"=>5.0]]
     * @return mixed
     */
    public function itemSet($appId, $itemName, $items);

    /**
     * 上报item属性
     * @param $appId
     * @param $itemName
     * @param $itemId
     * @param $itemParams
     * @return mixed
     */
    public function itemIdSet($appId, $itemName, $itemId, $itemParams);

    /**
     * unset item属性
     * @param $appId
     * @param $itemName
     * @param $itemId
     * @param $params
     * @return mixed
     */
    public function itemUnset($appId, $itemName, $itemId, $params);

    /**
     * delete item 属性
     * @param $appId
     * @param $itemName
     * @param $itemId
     * @param $itemParams
     * @return mixed
     */
    public function itemDelete($appId, $itemName, $itemId, $itemParams);
}