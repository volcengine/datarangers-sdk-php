<?php

require '../vendor/autoload.php';

use DataRangers\AppEventCollector;
use DataRangers\CollectorConfig;
use DataRangers\HttpConsumer;
use DataRangers\Model\Header;

CollectorConfig::init_datarangers_collector([
    "domain" => getenv("HTTP_DOMAIN"),
    "send" => true,
    "headers" => [
        "Host" => getenv("HTTP_HOST"),
        "Content-Type" => "application/json"
    ]
]);
$rc = new AppEventCollector(new HttpConsumer());
$rc->sendEvent("uuid16981", 10000034, null, ["__profile_set", "php_event"],
    [["php_name" => "php", "php_version" => "5.6"], ["php_name" => "php", "php_version" => "5.6"]]);

echo $rc->sendEvent("uuid16983", 10000034, null, "php_event",
    ["php_name" => "php", "php_version" => "5.6", "test_float_param" => floatval(5)]);

$header = new \DataRangers\Model\Header();
$header->setAppId(10000034);
$header->setUserUniqueId("uuid16985");
$header->setClientIp("49.7.44.244");
$header->setOs("android");
$rc->sendUserDefineEvent($header, "uuid16982", 10000034, null, "php_event",
    ["php_name" => "php", "php_version" => "5.6", "float_param" => floatval(5), "session_id" => "1234567890"]);