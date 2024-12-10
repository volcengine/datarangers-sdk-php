<?php

require '../vendor/autoload.php';

use DataRangers\AppEventCollector;
use DataRangers\CollectorConfig;

CollectorConfig::init_datarangers_collector([
    "domain" => "https://mcs.ctobsnssdk.com",
    "save" => false,
    "headers" => [
        "Content-Type" => "application/json"
    ],
    "app_keys" => [
        getenv("APP_ID") => getenv("APP_KEY")
    ],
    "openapi" => [
        "domain" => "https://analytics.volcengineapi.com",
        "ak" => getenv("OPENAPI_AK"),
        "sk" => getenv("OPENAPI_SK")
    ],
    "http_timeout"=> 10000
]);

$rc = new AppEventCollector();
# send event
$rc->sendEvent("test-uuidsdk1", getenv("APP_ID"), null, ["php_event"],
    [["php_name" => "php", "php_version" => "5.6", "event_coin1"=>0]]);

# send single event
$rc->sendEvent("test-uuidsdk1", getenv("APP_ID"), null, "php_single_event",
    ["php_name" => "php", "php_version" => "5.6", "event_coin2"=>0]);

# profile set
$rc->profileSet("test-uuidsdk1", getenv("APP_ID"), ["profile_php_name" => "php7", "profile_php_version" => "7.4", "profile_int" => 1, "profile_coin" => 0]);

# set item properties
$rc->itemIdSet(getenv("APP_ID"), "book", "book3", ["author" => "吴承恩", "name" => "西游记", "price" => 59.90, "category" => 1]);
$rc->itemIdSet(getenv("APP_ID"), "book", "book4", ["author" => "Guanzhong Luo", "name" => "SanGuoYanYi", "price" => 69.90, "category" => 1]);

# send event with item
$rc->sendEvent("test-uuidsdk1", getenv("APP_ID"), null, ["php_event_with_item"],
    [["php_name" => "php", "php_version" => "5.6"]], [
        [["item_name" => "book", "item_id" => "book3"], ["item_name" => "book", "item_id" => "book4"]]
    ]);

$rc->sendEvent("test-uuidsdk1", getenv("APP_ID"), null, "php_single_event_with_item",
    ["php_name" => "php", "php_version" => "5.6"],
    [["item_name" => "book", "item_id" => "book3"], ["item_name" => "book", "item_id" => "book4"]]
);