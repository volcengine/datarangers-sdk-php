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

$rc->sendEvent("uuid16981", 10000001, null, ["php_event1", "php_event2"],
    [["php_name" => "php7_1", "php_version" => "7.4_1"], ["php_name" => "php7_2", "php_version" => "7.4_2"]]);

$rc->profileSet("uuid16981", 10000001, ["profile_php_name" => "php7", "profile_php_version" => "7.4"]);

$rc->itemSet(10000001, "book", "book1", ["author" => "吴承恩", "name" => "西游记", "price" => 59.90, "category" => 1]);
$rc->itemSet(10000001, "book", "book2", ["author" => "Guanzhong Luo", "name" => "SanGuoYanYi", "price" => 69.90, "category" => 1]);


$rc->sendEvent("uuid16981", 10000001, null, ["php_event_with_item2"],
    [["php_name" => "php", "php_version" => "5.6"]],[["book"=>[["id"=>"book1"], ["id"=>"book2"]]]]);