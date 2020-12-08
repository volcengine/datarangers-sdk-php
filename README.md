# DataRangers

## 项目背景
datarangers-sdk-php是 [DataRangers](https://datarangers.com.cn/) 的用户行为采集服务端SDK。

服务端埋点支持在客户的服务端进行埋点采集和上报，作为客户端埋点的补充或替代，其支持的典型场景包括：
1. 客户端埋点+服务端埋点组合：该场景下，服务端埋点一般用来弥补客户端埋点覆盖不到的部分数据，是目前最常见的使用场景。
2. 纯服务端埋点：所有的埋点收集和上报都由服务端完成，需要的客户端数据则由服务端收集和提取后上报到DataRangers。

## 使用方法
1. 新建一个Laravel项目
2. 在composer.json中添加如下字段

    ```json
    {
    "require": {
            "datarangers/datarangers": "dev-dev"
        }
    }
    ```

3. 执行命令
    ```shell script
    composer require datarangers/datarangers
    ```
4. 首先加载配置项
    ```php
    CollectorConfig::init_datarangers_collector([
            "domain" => "http://domain",
            "send" => True,
            "headers" => [
                "Host" => "host",
                "Content-Type" => "application/json"
            ]
        ]);
    ```

5. 执行代码
    ```php
    $rc = new AppEventCollector(new HttpConsumer());
    $rc->sendEvent("uuid16980", 10000013, null, [ProfileMethod::SET, "php_event"],
        [["php_name" => "php", "php_version" => "5.6"], ["php_name" => "php", "php_version" => "5.6"]]);
    
    $rc->profileSet("uuid16980", 10000045,["php_name" => "php", "php_version" => "5.6"]);
    $rc->profileSetOnce("uuid16980", 10000045,["php_name" => "php", "php_version" => "5.6"]);
    $rc->profileIncrement("uuid16980", 10000045,["count" => 6]);
    $rc->profileAppend("uuid16980", 10000045,["php_arr" => ["index1","index2"]]);  
    ```
   
## License
Copyright 2020 Beijing Volcano Engine Technology Co., Ltd.

Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. 
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.