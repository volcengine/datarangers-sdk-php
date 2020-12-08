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
$rc->sendEvent("uuid16981", 10000002, null, ["__profile_set", "php_event"],
    [["php_name" => "php", "php_version" => "5.6"], ["php_name" => "php", "php_version" => "5.6"]]);