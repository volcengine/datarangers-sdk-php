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
            "datarangers/datarangers": "^1.0"
        }
    }
    ```

3. 执行命令
    ```shell script
    composer require datarangers/datarangers
    ```
4. 首先加载配置项
    ```php
    # 私有化部署场景 logagent模式
    CollectorConfig::init_datarangers_collector([
            "domain" => "http://domain",
            "save" => true,
            "headers" => [
                "Host" => "host",
                "Content-Type" => "application/json"
            ],
            "http_timeout"=> 10000
        ]);
   
   # 私有化部署场景 http 模式，Host 必须配置,Host 没有http://,https://
   CollectorConfig::init_datarangers_collector([
    "domain" => "https://xxxx",
    "save" => false,
    "headers" => [
        "Host" => "xxxx",
        "Content-Type" => "application/json"
    ],
    "http_timeout"=> 10000
   ]);
   
    # saas 云上环境
    CollectorConfig::init_datarangers_collector([
        "domain" => "https://xxxx",
        "save" => false,
        "headers" => [
            "Content-Type" => "application/json"
        ],
        "app_keys" => [
            1001 => getenv("APP_KEY")
        ],
        "openapi" => [
            "domain" => "https://xxxx",
            "ak" => getenv("OPENAPI_AK"),
            "sk" => getenv("OPENAPI_SK")
        ],
        "http_timeout"=> 10000
    ]);
   
    ```
   
   domain 配置说明：
   1. 私有化，请联系部署运维人员获取
   2. saas，根据接入的环境配置不同的地址：
      1. saas版本国内站：https://mcs.ctobsnssdk.com
      2. SaaS版国际站: https://mcs.tobsnssdk.com
      3. SaaS云原生版: https://gator.volces.com
   3. SAAS 上如果上报 item 和用户属性，需要设置openapi：
      1. domain:
         1. SaaS版国内站: https://analytics.volcengineapi.com
         2. SaaS版国际站: https://analytics.byteplusapi.com
         3. SaaS云原生版: https://analytics.volcengineapi.com
      4. ak/sk 请联系客户经理获取

5. 执行代码
    ```php
   $rc = new AppEventCollector(new HttpConsumer());
   $rc->sendEvent("uuid16980", 1001, null, [ProfileMethod::SET, "php_event"],
        [["php_name" => "php", "php_version" => "5.6"], ["php_name" => "php", "php_version" => "5.6"]]);
    
   $rc->profileSet("uuid16980", 1001,["php_name" => "php", "php_version" => "5.6"]);
   $rc->profileSetOnce("uuid16980", 1001,["php_name" => "php", "php_version" => "5.6"]);
   $rc->profileIncrement("uuid16980", 1001,["count" => 6]);
   $rc->profileAppend("uuid16980", 1001,["php_arr" => ["index1","index2"]]);  
   
   # set item properties
   $rc->itemIdSet(getenv("APP_ID"), "book", "book3", ["author" => "吴承恩", "name" => "西游记", "price" => 59.90, "category" => 1]);
   $rc->itemIdSet(getenv("APP_ID"), "book", "book4", ["author" => "Guanzhong Luo", "name" => "SanGuoYanYi", "price" => 69.90, "category" => 1]);

   # 在事件中上报item
   $rc->sendEvent("test-uuidsdk1", getenv("APP_ID"), null, "php_single_event_with_item",
        ["php_name" => "php", "php_version" => "5.6"],
        [["item_name" => "book", "item_id" => "book3"], ["item_name" => "book", "item_id" => "book4"]]
   );
    ```
   
## License
Copyright 2020 Beijing Volcano Engine Technology Co., Ltd.

Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. 
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
