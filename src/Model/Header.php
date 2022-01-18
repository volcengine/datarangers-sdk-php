<?php
/*
 * Copyright 2020 Beijing Volcano Engine Technology Co., Ltd.
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 */

namespace DataRangers\Model;

use DataRangers\CollectorConfig;
use DataRangers\Model\Message\MessageEnv;
use DataRangers\Model\Util\Constants;

class Header implements \JsonSerializable
{
    private $aid;
    private $appLanguage;
    private $appName;
    private $appRegion;
    private $appVersion;
    private $appVersionMinor;
    private $appKey;
    private $buildSerial;
    private $carrier;
    private $channel;
    private $clientudid;
    private $cpuAbi;
    private $custom;
    private $deviceId;
    private $deviceBrand;
    private $deviceManufacturer;
    private $deviceModel;
    private $deviceType;
    private $displayName;
    private $displayDensity;
    private $densityDpi;
    private $idfa;
    private $installId;
    private $language;
    private $openudid;
    private $os;
    private $osApi;
    private $osVersion;
    private $package;
    private $region;
    private $sdkVersion;
    private $timezone;
    private $tzOffset;
    private $tzName;
    private $udid;
    private $userUniqueId;
    private $vendorId;

    public function __construct()
    {
        $this->timezone = Constants::$TIME_ZONE_OFFSET;
        $this->tzOffset = Constants::$TIME_ZONE_OFFSET_CURRENT;
        $this->tzName = Constants::$TIME_ZONE_NAME;
        $this->deviceId = 1;
    }

    /**
     * @param mixed $aid
     */
    public function setAppId($aid)
    {
        $this->aid = $aid;
    }

    /**
     * @param mixed $appLanguage
     */
    public function setAppLanguage($appLanguage)
    {
        $this->appLanguage = $appLanguage;
    }

    /**
     * @param mixed $appName
     */
    public function setAppName($appName)
    {
        $this->appName = $appName;
    }

    /**
     * @param mixed $appRegion
     */
    public function setAppRegion($appRegion)
    {
        $this->appRegion = $appRegion;
    }

    /**
     * @param mixed $appVersion
     */
    public function setAppVersion($appVersion)
    {
        $this->appVersion = $appVersion;
    }

    /**
     * @param mixed $appVersionMinor
     */
    public function setAppVersionMinor($appVersionMinor)
    {
        $this->appVersionMinor = $appVersionMinor;
    }

    /**
     * @param mixed $appKey
     */
    public function setAppKey($appKey)
    {
        $this->appKey = $appKey;
    }

    /**
     * @param mixed $buildSerial
     */
    public function setBuildSerial($buildSerial)
    {
        $this->buildSerial = $buildSerial;
    }

    /**
     * @param mixed $carrier
     */
    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;
    }

    /**
     * @param mixed $channel
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
    }

    /**
     * @param mixed $clientudid
     */
    public function setClientudid($clientudid)
    {
        $this->clientudid = $clientudid;
    }

    /**
     * @param mixed $cpuAbi
     */
    public function setCpuAbi($cpuAbi)
    {
        $this->cpuAbi = $cpuAbi;
    }

    /**
     * @param mixed $custom
     */
    public function setCustom($custom)
    {
        $this->custom = $custom;
    }

    /**
     * @param mixed $deviceId
     */
    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;
    }

    /**
     * @param mixed $deviceBrand
     */
    public function setDeviceBrand($deviceBrand)
    {
        $this->deviceBrand = $deviceBrand;
    }

    /**
     * @param mixed $deviceManufacturer
     */
    public function setDeviceManufacturer($deviceManufacturer)
    {
        $this->deviceManufacturer = $deviceManufacturer;
    }

    /**
     * @param mixed $deviceModel
     */
    public function setDeviceModel($deviceModel)
    {
        $this->deviceModel = $deviceModel;
    }

    /**
     * @param mixed $deviceType
     */
    public function setDeviceType($deviceType)
    {
        $this->deviceType = $deviceType;
    }

    /**
     * @param mixed $displayName
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

    /**
     * @param mixed $displayDensity
     */
    public function setDisplayDensity($displayDensity)
    {
        $this->displayDensity = $displayDensity;
    }

    /**
     * @param mixed $densityDpi
     */
    public function setDensityDpi($densityDpi)
    {
        $this->densityDpi = $densityDpi;
    }

    /**
     * @param mixed $idfa
     */
    public function setIdfa($idfa)
    {
        $this->idfa = $idfa;
    }

    /**
     * @param mixed $installId
     */
    public function setInstallId($installId)
    {
        $this->installId = $installId;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @param mixed $openudid
     */
    public function setOpenudid($openudid)
    {
        $this->openudid = $openudid;
    }

    /**
     * @param mixed $os
     */
    public function setOs($os)
    {
        $this->os = $os;
    }

    /**
     * @param mixed $osApi
     */
    public function setOsApi($osApi)
    {
        $this->osApi = $osApi;
    }

    /**
     * @param mixed $osVersion
     */
    public function setOsVersion($osVersion)
    {
        $this->osVersion = $osVersion;
    }

    /**
     * @param mixed $package
     */
    public function setPackage($package)
    {
        $this->package = $package;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * @param mixed $sdkVersion
     */
    public function setSdkVersion($sdkVersion)
    {
        $this->sdkVersion = $sdkVersion;
    }

    /**
     * @param mixed $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * @param string $tzOffset
     */
    public function setTzOffset($tzOffset)
    {
        $this->tzOffset = $tzOffset;
    }

    /**
     * @param string $tzName
     */
    public function setTzName($tzName)
    {
        $this->tzName = $tzName;
    }

    /**
     * @param mixed $udid
     */
    public function setUdid($udid)
    {
        $this->udid = $udid;
    }

    /**
     * @param mixed $userUniqueId
     */
    public function setUserUniqueId($userUniqueId)
    {
        $this->userUniqueId = $userUniqueId;
    }

    /**
     * @param mixed $vendorId
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;
    }

    public function jsonSerialize()
    {
        $data = [];
        if ($this->aid != null && CollectorConfig::$env != MessageEnv::SAAS) {
            $data["app_id"] = $this->aid;
            $data["aid"] = $this->aid;
        }
        if ($this->appLanguage != null) $data["app_language"] = $this->appLanguage;
        if ($this->appName != null) $data["app_name"] = $this->appName;
        if ($this->appRegion != null) $data["app_region"] = $this->appRegion;
        if ($this->appVersion != null) $data["app_version"] = $this->appVersion;
        if ($this->appVersionMinor != null) $data["app_version_minor"] = $this->appVersionMinor;
        if ($this->appKey != null) $data["app_key"] = $this->appKey;
        if ($this->buildSerial != null) $data["build_serial"] = $this->buildSerial;
        if ($this->carrier != null) $data["carrier"] = $this->carrier;
        if ($this->channel != null) $data["channel"] = $this->channel;
        if ($this->clientudid != null) $data["clientudid"] = $this->clientudid;
        if ($this->cpuAbi != null) $data["cpu_abi"] = $this->cpuAbi;
        if ($this->custom != null) $data["custom"] = $this->custom;
        if ($this->deviceId != null) $data["device_id"] = $this->deviceId;
        if ($this->deviceBrand != null) $data["device_brand"] = $this->deviceBrand;
        if ($this->deviceManufacturer != null) $data["device_manufacturer"] = $this->deviceManufacturer;
        if ($this->deviceModel != null) $data["device_model"] = $this->deviceModel;
        if ($this->deviceType != null) $data["device_type"] = $this->deviceType;
        if ($this->displayName != null) $data["display_name"] = $this->displayName;
        if ($this->displayDensity != null) $data["display_density"] = $this->displayDensity;
        if ($this->densityDpi != null) $data["density_dpi"] = $this->densityDpi;
        if ($this->idfa != null) $data["idfa"] = $this->idfa;
        if ($this->installId != null) $data["install_id"] = $this->installId;
        if ($this->language != null) $data["language"] = $this->language;
        if ($this->openudid != null) $data["openudid"] = $this->openudid;
        if ($this->os != null) $data["os"] = $this->os;
        if ($this->osApi != null) $data["os_api"] = $this->osApi;
        if ($this->osVersion != null) $data["os_version"] = $this->osVersion;
        if ($this->package != null) $data["package"] = $this->package;
        if ($this->region != null) $data["region"] = $this->region;
        if ($this->sdkVersion != null) $data["sdk_version"] = $this->sdkVersion;
        if ($this->timezone != null) $data["timezone"] = $this->timezone;
        if ($this->tzOffset != null) $data["tz_offset"] = $this->tzOffset;
        if ($this->tzName != null) $data["tz_name"] = $this->tzName;
        if ($this->udid != null) $data["udid"] = $this->udid;
        if ($this->userUniqueId != null) $data["user_unique_id"] = $this->userUniqueId;
        if ($this->vendorId != null) $data["vendor_id"] = $this->vendorId;
        return $data;
    }
}