<?php

require '../vendor/autoload.php';

use DataRangers\AppEventCollector;
use DataRangers\CollectorConfig;
use DataRangers\Model\Header;
use DataRangers\WebEventCollector;

CollectorConfig::init_datarangers_collector([
    "domain" => getenv("HTTP_DOMAIN"),
    "save" => false,
    "headers" => [
        "Content-Type" => "application/json"
    ],
    "http_timeout"=> 10000
]);
$rc = new AppEventCollector();

$item = [
    ["item_id" => "0001", "item_name" => "book", "price" => 5.01, "versions" => [1, 2, 3]],
    ["item_id" => "0002", "item_name" => "book", "price" => 5.02, "author" => "JK Rowling"]
];

$rc->itemSet(10000000, "book", $item);
$rc->itemSet(10000000, "phone", [
     ["item_id" => "0003", "item_name" => "phone", "price" => 6000, "version" => "6s"]
    ]);


// send multiple event
$rc->sendEvent("test-uuid1", 10000000, null, ["__profile_set", "php_event"],
    [["php_name" => "php", "php_version" => "5.6", "float_param" => floatval(5)], ["php_name" => "php", "php_version" => "5.6"]]);

// send single event with item
$items = [
    ["item_name" => "book", "item_id" => "0001"],
    ["item_name" => "book", "item_id" => "0002"],
    ["item_name" => "phone", "item_id" => "0003"]
];
$rc->sendEvent("test-uuid1", 10000000, null, "php_event_with_items",
    ["php_name" => "php", "php_version" => "5.6", "float_param" => floatval(5)], $items);

// use custom header
$header = new Header();
$header->setAppId(10000000);
$header->setUserUniqueId("test-uuid2");
$header->setClientIp("49.7.44.244");
$header->setOs("android");
$header->setDeviceId(7786627007290925058);

$rc->sendUserDefineEvent($header, "", 10000000, null, "php_event_with_anonymous",
    ["php_name" => "php", "php_version" => "5.6", "float_param" => floatval(5), "session_id" => "1234567890"]);


$rc->sendUserDefineEvent($header, "test-uuid2", 10000000, null, "php_event_with_items",
    ["php_name" => "php", "php_version" => "5.6", "float_param" => floatval(5), "session_id" => "1234567890"], $items);


// unset item properties
$rc->itemUnset(10000000, "book", "0001", ["price"]);

// set profile
$rc->profileSet("test-uuid3", 10000000, ["php_name" => "php", "php_version" => "5.6", "float_param" => floatval(5)]);

// send multiple events
$rc->sendEvent("test-uuid1", 10000001, null, ["php_event1", "php_event2"],
    [["php_name" => "php7_1", "php_version" => "7.4_1"], ["php_name" => "php7_2", "php_version" => "7.4_2"]]);

// set single item properties
$rc->itemIdSet(10000001, "book", "book1", ["author" => "吴承恩", "name" => "西游记", "price" => 59.90, "category" => 1]);
$rc->itemIdSet(10000001, "book", "book2", ["author" => "Guanzhong Luo", "name" => "SanGuoYanYi", "price" => 69.90, "category" => 1]);

// send multi events with items
$rc->sendEvent("test-uuid1", 10000001, null, ["php_event_with_item"],
    [["php_name" => "php", "php_version" => "5.6"]], [
        [["item_name" => "book", "item_id" => "0001"], ["item_name" => "book", "item_id" => "0002"]]
    ]);

$header2 = new Header();
$header2->setAppId(10000000);
$header2->setUserUniqueId("");
$header2->setDeviceId(7033713549469860107);
$rc->profileSetWithHeader($header2, ["profile_php_name" => "php7", "profile_php_version" => "7.4", "profile_int" => 2, "testdate"=>"2023-05-16"]);

// anonymousId
$webRc = new WebEventCollector();
$header3 = new Header();
$header3->setAppId(10000000);
$header3->setUserUniqueId("");
$header3->setAnonymousId("test_anonymousId1");
$webRc->sendUserDefineEvent($header3, "", 10000000, null, "php_event_with_anonymous_id",
    ["php_name" => "php", "php_version" => "5.6", "float_param" => floatval(5), "session_id" => "1234567890"]);



// user_unique_id_type
$appRc = new AppEventCollector();
$header3 = new Header();
$header3->setAppId(10000000);
$header3->setUserUniqueIdType("phone_id");
$appRc->sendUserDefineEvent($header3, "test_sdk_phone_id1", 10000000, null, "php_event_with_anonymous_id",
    ["php_name" => "php", "php_version" => "5.6", "float_param" => floatval(5), "session_id" => "1234567890"]);


sleep(10);
printf("end");
