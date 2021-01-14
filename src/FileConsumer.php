<?php
/*
 * Copyright 2020 Beijing Volcano Engine Technology Co., Ltd.
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 */

namespace DataRangers;

use DataRangers\CollectorConfig;

class FileConsumer extends AbstractConsumer
{
    private $output;
    private $targetPrefix;
    private $targetName;
    private $fullTarget;
    private $currentName;
    private $currentIndex;
    private $count;

    /**
     * FileConsumer constructor.
     */
    public function __construct()
    {
        if (substr_compare(CollectorConfig::getLogFileName(), ".log", -4) == 0) {
            $this->targetName = substr(CollectorConfig::getLogFileName(), 0, strlen(CollectorConfig::getLogFileName()) - 4);
        } else {
            $this->targetName = CollectorConfig::getLogFileName();
        }
        $this->targetPrefix = CollectorConfig::getLogFilePath() . (substr_compare(CollectorConfig::getLogFilePath(), "/", -1) == 0 ? "" : "/");
        if (!is_dir($this->targetPrefix)) {
            mkdir($this->targetPrefix, 0700, true);
        }
        $this->currentIndex = $this->setCurrentIndex();
        if ($this->currentIndex != 0) $this->currentIndex++;
        $this->fullTarget = $this->targetPrefix . $this->targetName . ".log";
        $this->currentName = $this->targetName . "." . date("Y.m.d.H", time());
        $this->output = fopen($this->fullTarget, "a+");
        $this->changeOutputStream();
    }

    private function setCurrentIndex()
    {
        $current = $this->targetName . "." . date("Y.m.d.H", time());
        $number = 0;
        $dirHandle = opendir($this->targetPrefix);
        while ($file = readdir($dirHandle)) {
            if (strpos($file, $current) == 0) {
                $arr = str_replace(".log", "", str_replace($current . ".", "", $file));
                try {
                    $index = (int)$arr;
                    $number = max($number, $index);
                } catch (\Exception $e) {
                    continue;
                }
            }
        }
        return $number;
    }

    private function changeOutputStream()
    {
        if (filesize($this->fullTarget) >= CollectorConfig::getLogMaxBytes()) {
            $currentHour = $this->targetName . "." . date("Y.m.d.H", time());
            if (strcmp($currentHour, $this->currentName) == 0) {
                if (!rename($this->fullTarget, $this->targetPrefix . $currentHour . "." . $this->currentIndex . ".log")) {
                    throw new RangersSDKException("rename error![" . $this->fullTarget . "]");
                }
                $this->currentIndex++;
                $this->close();
                $this->output = fopen($this->fullTarget, "a+");
            } else {
                $this->close();
                if (!rename($this->fullTarget, $this->targetPrefix . $this->currentName . "." . $this->currentIndex)) {
                    throw new RangersSDKException("rename error![" . $this->fullTarget . "]");
                }
                $this->close();
                $this->output = fopen($this->fullTarget, "a+");
                $this->currentName = $currentHour;
                $this->currentIndex = 0;
            }
            $this->count = 0;
        }
    }


    public function send($msg)
    {
        if ($msg != null) {
            $state = fwrite($this->output, json_encode($msg, JSON_PRESERVE_ZERO_FRACTION) . "\n");
            $this->count++;
            if ($this->count > 10000) {
                $this->changeOutputStream();
            }
            return $state;
        } else return false;
    }

    public function close()
    {
        if ($this->output == null) return true;
        if (is_resource($this->output))
            return fclose($this->output);
        return true;
    }

    function __destruct()
    {
        parent::__destruct();
    }
}