<?php
/*
 * Copyright 2020 Beijing Volcano Engine Technology Co., Ltd.
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 */
namespace DataRangers\Model\Util;
class HttpRequests
{
    public static function doRequest($method, $url, $headers, $params, $body, $timeout = 1000)
    {
        if ($params != null) $url = $url . HttpRequests::formatParams($params);
        $ch = curl_init($url);
        $header = [];
        foreach ($headers as $key => $value) {
            $header[] = $key . ":" . $value;
        }
        if ($method != "GET") $header[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $sendBody=json_encode($body);
        switch ($method) {
            case "GET":
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                break;
            case "POST":
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $sendBody);
                break;
            default:
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $sendBody);
                break;
        }
        $content = curl_exec($ch);
        var_dump($content);
        return $content;
        curl_close($ch);
    }

    public static function post($url, $headers, $params, $body, $timeout = 120)
    {
        return HttpRequests::doRequest("POST", $url, $headers, $params, $body, $timeout);
    }

    public static function get($url, $headers = null, $params = null, $body = null, $timeout = 120)
    {
        return HttpRequests::doRequest("GET", $url, $headers, $params, $body, $timeout);
    }

    private static function request($url, $options)
    {
        $context = stream_context_create($options);
        return file_get_contents($url, false, $context);
    }

    private static function formatParams($params)
    {
        $param = "?";
        foreach ($params as $key => $value) {
            $param = $param . $key . "=" . urlencode($value) . "&";
        }
        return substr($param, 0, strlen($param) - 1);
    }

    private static function formatHeaders($headers, $contentType = false)
    {
        $header = "";
        foreach ($headers as $key => $value) {
            $header = $header . $key . ": " . $value . "\r\n";
        }
        if ($contentType) {
            $header = $header . "Content-Type : application/json\r\n";
        }
        return $header;
    }

}