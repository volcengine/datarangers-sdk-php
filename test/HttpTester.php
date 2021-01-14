<?php

require '../vendor/autoload.php';

use DataRangers\AppEventCollector;
use DataRangers\CollectorConfig;
use DataRangers\HttpConsumer;

CollectorConfig::init_datarangers_collector([
    "domain" => getenv("HTTP_DOMAIN"),
    "send" => true,
    "headers" => [
        "Host" => getenv("HTTP_HOST"),
        "Content-Type" => "application/json"
    ]
]);
$rc = new AppEventCollector(new HttpConsumer());
$rc->sendEvent("uuid16981", 10000001, null, ["__profile_set", "php_event"],
    [["php_name" => "php", "php_version" => "5.6"], ["php_name" => "php", "php_version" => "5.6"]]);

echo $rc->sendEvent("uuid16981", 10000004, null, "php_event",
    ["php_name" => "php", "php_version" => "5.6", "test_float_param" => floatval(5)]);