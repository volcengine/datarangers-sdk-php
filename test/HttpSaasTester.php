<?php

require '../vendor/autoload.php';

use DataRangers\AppEventCollector;
use DataRangers\CollectorConfig;
use DataRangers\HttpConsumer;

CollectorConfig::init_datarangers_collector([
    "domain" => "https://mcs.ctobsnssdk.com",
    "send" => true,
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
    ]
]);

$rc = new AppEventCollector(new HttpConsumer());
$rc->sendEvent("test-uuidsdk", getenv("APP_ID"), null, ["php_event"],
    [["php_name" => "php", "php_version" => "5.6"]]);

$rc->profileSet("test-uuidsdk", getenv("APP_ID"), ["profile_php_name" => "php7", "profile_php_version" => "7.4", "profile_int" => 1]);

$rc->itemSet(getenv("APP_ID"), "book", "book1", ["author" => "吴承恩", "name" => "西游记", "price" => 59.90, "category" => 1]);
$rc->itemSet(getenv("APP_ID"), "book", "book2", ["author" => "Guanzhong Luo", "name" => "SanGuoYanYi", "price" => 69.90, "category" => 1]);


$rc->sendEvent("test-uuidsdk", getenv("APP_ID"), null, ["php_event_with_item"],
    [["php_name" => "php", "php_version" => "5.6"]], [["book" => [["id" => "book1"], ["id" => "book2"]]]]);