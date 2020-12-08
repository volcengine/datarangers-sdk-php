<?php
/*
 * Copyright 2020 Beijing Volcano Engine Technology Co., Ltd.
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 */

namespace DataRangers;

use DataRangers\Model\Util\Constants;

class CollectorConfig
{
    public static $SAVE;
    public static $SEND;
    public static $LOG_FILE_PATH;
    public static $LOG_FILE_NAME;
    public static $LOG_MAX_BYTES;
    public static $URL;
    public static $SEND_HEADER;
    public static $INIT_FLAG;
    public static $HTTP_TIMEOUT;

    public static function init_datarangers_collector($config)
    {
        if(self::get($config, "save", false)){
            self::setSAVE(true);
            self::setSEND(false);
        }else{
            self::setSAVE(false);
            self::setSEND(true);
        }
        if (array_key_exists("domain", $config)) {
            self::setURL($config["domain"] . Constants::$APP_LOG_URL);
        } else if (self::isSend()) {
            throw new RangersSDKException(Constants::$DOMAIN_EXCPETION);
        }

        self::setLogFilePath(self::get($config, "logger_file_prefix", "logs/datarangers/"));
        self::setLogFileName(self::get($config, "logger_file_name", "datarangers"));
        self::setLogMaxBytes(self::get($config, "log_max_bytes", 1024 * 1024 * 10));
        self::setSenderHeader(self::get($config, "headers", []));
        self::setHttpTimeout(self::get($config, "http_timeout", 1000));
        self::$INIT_FLAG = true;
    }

    public static function isOk()
    {
        return self::$INIT_FLAG;
    }

    /**
     * @return mixed
     */
    public static function getLogFileName()
    {
        return self::$LOG_FILE_NAME;
    }

    /**
     * @param mixed $LOG_FILE_NAME
     */
    public static function setLogFileName($LOG_FILE_NAME)
    {
        self::$LOG_FILE_NAME = $LOG_FILE_NAME;
    }

    public static function get($arr, $key, $default)
    {
        if (in_array($key, $arr)) {
            return !empty($arr[$key]) ? $arr[$key] : $default;
        } else return $default;
    }

    /**
     * @return mixed
     */
    public static function isSave()
    {
        return self::$SAVE;
    }

    /**
     * @param mixed $SAVE
     */
    public static function setSave($SAVE)
    {
        self::$SAVE = $SAVE;
    }

    /**
     * @return mixed
     */
    public static function isSend()
    {
        return self::$SEND;
    }

    /**
     * @param mixed $SEND
     */
    public static function setSend($SEND)
    {
        self::$SEND = $SEND;
    }

    /**
     * @return mixed
     */
    public static function getLogFilePath()
    {
        return self::$LOG_FILE_PATH;
    }

    /**
     * @param mixed $LOG_FILE_PATH
     */
    public static function setLogFilePath($LOG_FILE_PATH)
    {
        self::$LOG_FILE_PATH = $LOG_FILE_PATH;
    }

    /**
     * @return mixed
     */
    public static function getLogMaxBytes()
    {
        return self::$LOG_MAX_BYTES;
    }

    /**
     * @param mixed $LOG_MAX_BYTES
     */
    public static function setLogMaxBytes($LOG_MAX_BYTES)
    {
        self::$LOG_MAX_BYTES = $LOG_MAX_BYTES;
    }

    /**
     * @return mixed
     */
    public static function getURL()
    {
        return self::$URL;
    }

    /**
     * @param mixed $URL
     */
    public static function setURL($URL)
    {
        self::$URL = $URL;
    }

    /**
     * @return mixed
     */
    public static function getSendHeader()
    {
        return self::$SEND_HEADER;
    }

    /**
     * @param mixed $SEND_HEADER
     */
    public static function setSenderHeader($SEND_HEADER)
    {
        self::$SEND_HEADER = $SEND_HEADER;
        self::$SEND_HEADER["User-Agent"] = "PHP SDK/2.0.0 (OnPremise)";
        self::$SEND_HEADER["Content-Type"] = "application/json";
    }

    /**
     * @return mixed
     */
    public static function getHttpTimeout()
    {
        return self::$HTTP_TIMEOUT;
    }

    /**
     * @param mixed $HTTP_TIME_OUT
     */
    public static function setHttpTimeout($HTTP_TIME_OUT)
    {
        self::$HTTP_TIMEOUT = $HTTP_TIME_OUT;
    }

}