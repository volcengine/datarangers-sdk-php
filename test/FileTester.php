<?php
require '../vendor/autoload.php';

use DataRangers\AppEventCollector;
use DataRangers\CollectorConfig;
use DataRangers\Model\Header;

CollectorConfig::init_datarangers_collector([
    "save" => true,
    "logger_file_prefix" => "sdk/log/",
    "logger_file_name" => "datarangers.log",
    "log_max_mb" => 50
]);
$rc = new AppEventCollector();

// set items
$item = [
    ["item_id" => "0001", "item_name" => "book", "price" => 5.01, "versions" => [1, 2, 3]],
    ["item_id" => "0002", "item_name" => "book", "price" => 5.02, "author" => "JK Rowling"]
];
$rc->itemSet(10000002, "book", $item);
$rc->itemSet(10000002, "phone", [
    ["item_id" => "0003", "item_name" => "phone", "price" => 6000, "version" => "6s"]
]);

// send single event with item
$items = [
    ["item_name" => "book", "item_id" => "0001"],
    ["item_name" => "book", "item_id" => "0002"],
    ["item_name" => "phone", "item_id" => "0003"]
];

$rc->sendEvent("test-uuid1", 10000002, null, "php_event",
    ["php_name" => "php", "php_version" => "5.6", "float_param" => floatval(5)], $items);

// send multiple event
$rc->sendEvent("test-uuid2", 10000002, null, ["__profile_set", "php_event"],
    [["php_name" => "php", "php_version" => "5.6", "float_param" => floatval(5)], ["php_name" => "php", "php_version" => "5.6"]]);

// use custom header
$header = new Header();
$header->setAppId(10000002);
$header->setUserUniqueId("test-uuid3");
$header->setClientIp("49.7.44.244");
$header->setOs("android");
$rc->sendUserDefineEvent($header, "test-uuid3", 10000002, null, "php_event",
    ["php_name" => "php", "php_version" => "5.6", "float_param" => floatval(5), "session_id" => "1234567890"], $item);

// unset item
$rc->itemUnset(10000002, "book", "0001", ["param1", "param2"]);

// set profile
$rc->profileSet("test-uuid2", 10000002, ["php_name" => "php", "php_version" => "5.6", "float_param" => floatval(5)]);


// set single item
$rc->itemIdSet(10000001, "book", "book1", ["author" => "吴承恩", "name" => "西游记", "price" => 59.90, "category" => 1]);
$rc->itemIdSet(10000001, "book", "book2", ["author" => "Guanzhong Luo", "name" => "SanGuoYanYi", "price" => 69.90, "category" => 1]);

// send event with item
$rc->sendEvent("test-uuid1", 10000001, null, ["php_event_with_item"],
    [["php_name" => "php", "php_version" => "5.6"]], [
                [["item_name" => "book", "item_id" => "0001"], ["item_name" => "book", "item_id" => "0002"]]
            ]);
