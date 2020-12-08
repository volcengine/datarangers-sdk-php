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
$rc->sendEvent("uuid16981", 10000002, null, ["__profile_set", "php_event"],
    [["php_name" => "php", "php_version" => "5.6"], ["php_name" => "php", "php_version" => "5.6"]]);