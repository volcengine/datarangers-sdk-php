<?php
require '../vendor/autoload.php';

use DataRangers\AppEventCollector;
use DataRangers\CollectorConfig;
use DataRangers\FileConsumer;

CollectorConfig::init_datarangers_collector([
    "save" => true,
    "logger_file_prefix" => "sdk/log/",
    "logger_file_name" => "datarangers.log",
    "log_max_bytes" => 1024 * 10
]);
$rc = new AppEventCollector(new FileConsumer());
//example01: send multiple event
$rc->sendEvent("uuid16981", 10000002, null, ["__profile_set", "php_event"],
    [["php_name" => "php", "php_version" => "5.6","float_param"=>floatval(5)], ["php_name" => "php", "php_version" => "5.6", "items" => [
        ["item_id" => "0001", "item_name" => "book"], ["item_id" => "0002", "item_name" => "book"], ["item_id" => "0001", "item_name" => "phone"]
    ]]]);
$rc->sendEvent("uuid16981", 10000002, null, "php_event",
    ["php_name" => "php", "php_version" => "5.6", "float_param" => floatval(5)]);
$rc->itemUnset(10000002, "book", "0001", ["param1", "param2"]);
//example02: send item set event
$rc->itemSet(10000002, ["item_id" => "0002", "item_name" => "book", "name" => "name", "price" => 1.2]);
//example03: send profile set event
$rc->profileSet("uuid16981", 10000002,["php_name" => "php", "php_version" => "5.6","float_param"=>floatval(5)]);