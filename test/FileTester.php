<?php
require '../vendor/autoload.php';

use DataRangers\AppEventCollector;
use DataRangers\CollectorConfig;
use DataRangers\FileConsumer;
use DataRangers\Model\Header;

CollectorConfig::init_datarangers_collector([
    "save" => true,
    "logger_file_prefix" => "sdk/log/",
    "logger_file_name" => "datarangers.log",
    "log_max_mb" => 50
]);
$rc = new AppEventCollector(new FileConsumer());
//example01: send multiple event
for ($i = 0; $i < 200000; $i++) {
    $rc->sendEvent("uuid16981", 10000002, null, ["__profile_set", "php_event"],
        [["php_name" => "php", "php_version" => "5.6", "float_param" => floatval(5)], ["php_name" => "php", "php_version" => "5.6", "items" => [
            ["item_id" => "0001", "item_name" => "book"], ["item_id" => "0002", "item_name" => "book"], ["item_id" => "0001", "item_name" => "phone"]
        ]]]);
    $rc->sendEvent("uuid16982", 10000002, null, "php_event",
        ["php_name" => "php", "php_version" => "5.6", "float_param" => floatval(5)]);
    $header = new \DataRangers\Model\Header();
    $header->setAppId(10000002);
    $header->setUserUniqueId("uuid16985");
    $header->setClientIp("49.7.44.244");
    $header->setOs("android");
    $rc->sendUserDefineEvent($header, "uuid16982", 10000002, null, "php_event",
        ["php_name" => "php", "php_version" => "5.6", "float_param" => floatval(5), "session_id" => "1234567890"]);
    $rc->itemUnset(10000002, "book", "0001", ["param1", "param2"]);

//example02: send item set event
    $rc->itemSet(10000002, "book", ["item_id" => "0002", "item_name" => "book", "name" => "name", "price" => 1.2]);
//example03: send profile set event
    $rc->profileSet("uuid16983", 10000002, ["php_name" => "php", "php_version" => "5.6", "float_param" => floatval(5)]);
}
