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
$rc->sendEvent("uuid16981", 10000001, null, ["__profile_set", "php_event"],
    [["php_name" => "php", "php_version" => "5.6"], ["php_name" => "php", "php_version" => "5.6"]]);

$rc->itemSet(10000001, "book", "book1", ["author" => "吴承恩", "name" => "西游记", "price" => 59.90, "category" => 1]);
$rc->itemSet(10000001, "book", "book2", ["author" => "Guanzhong Luo", "name" => "SanGuoYanYi", "price" => 69.90, "category" => 1]);


$rc->sendEvent("uuid16981", 10000001, null, ["php_event_with_item"],
    [["php_name" => "php", "php_version" => "5.6"]],[["book"=>[["id"=>"book1"], ["id"=>"book2"]]]]);