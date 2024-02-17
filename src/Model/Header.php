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
    private $app_id;
    private $app_language;
    private $app_name;
    private $app_region;
    private $app_version;
    private $app_version_minor;
    private $app_key;
    private $build_serial;
    private $client_ip;
    private $carrier;
    private $channel;
    private $clientudid;
    private $cpu_abi;
    private $custom;
    private $device_id;
    private $device_brand;
    private $device_manufacturer;
    private $device_model;
    private $device_type;
    private $display_name;
    private $display_density;
    private $density_dpi;
    private $idfa;
    private $install_id;
    private $language;
    private $openudid;
    private $os;
    private $os_api;
    private $os_version;
    private $package;
    private $region;
    private $sdk_version;
    private $timezone;
    private $tz_offset;
    private $tz_name;
    private $udid;
    private $user_unique_id;
    private $vendor_id;
    private $ssid;

    private $anonymous_id;

    private $user_unique_id_type;

    /**
     * @return mixed
     */
    public function getAnonymousId(): string
    {
        return $this->anonymous_id;
    }

    /**
     * @param mixed $anonymous_id
     */
    public function setAnonymousId(string $anonymous_id): void
    {
        $this->anonymous_id = $anonymous_id;
    }



    /**
     * @return mixed
     */
    public function getSsid()
    {
        return $this->ssid;
    }

    /**
     * @param mixed $ssid
     */
    public function setSsid($ssid): void
    {
        $this->ssid = $ssid;
    }

    public function __construct()
    {
        $this->timezone = Constants::$TIME_ZONE_OFFSET;
        $this->tz_offset = Constants::$TIME_ZONE_OFFSET_CURRENT;
        $this->tz_name = Constants::$TIME_ZONE_NAME;
        $this->device_id = 0;
    }

    /**
     * @return mixed
     */
    public function getAid()
    {
        return $this->aid;
    }

    /**
     * @param mixed $aid
     */
    public function setAid($aid): void
    {
        $this->aid = $aid;
        $this->app_id = $aid;
    }

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->app_id;
    }

    /**
     * @param mixed $app_id
     */
    public function setAppId($app_id): void
    {
        $this->app_id = $app_id;
        $this->aid = $app_id;
    }

    /**
     * @return mixed
     */
    public function getAppLanguage()
    {
        return $this->app_language;
    }

    /**
     * @param mixed $app_language
     */
    public function setAppLanguage($app_language): void
    {
        $this->app_language = $app_language;
    }

    /**
     * @return mixed
     */
    public function getAppName()
    {
        return $this->app_name;
    }

    /**
     * @param mixed $app_name
     */
    public function setAppName($app_name): void
    {
        $this->app_name = $app_name;
    }

    /**
     * @return mixed
     */
    public function getAppRegion()
    {
        return $this->app_region;
    }

    /**
     * @param mixed $app_region
     */
    public function setAppRegion($app_region): void
    {
        $this->app_region = $app_region;
    }

    /**
     * @return mixed
     */
    public function getAppVersion()
    {
        return $this->app_version;
    }

    /**
     * @param mixed $app_version
     */
    public function setAppVersion($app_version): void
    {
        $this->app_version = $app_version;
    }

    /**
     * @return mixed
     */
    public function getAppVersionMinor()
    {
        return $this->app_version_minor;
    }

    /**
     * @param mixed $app_version_minor
     */
    public function setAppVersionMinor($app_version_minor): void
    {
        $this->app_version_minor = $app_version_minor;
    }

    /**
     * @return mixed
     */
    public function getAppKey()
    {
        return $this->app_key;
    }

    /**
     * @param mixed $app_key
     */
    public function setAppKey($app_key): void
    {
        $this->app_key = $app_key;
    }

    /**
     * @return mixed
     */
    public function getBuildSerial()
    {
        return $this->build_serial;
    }

    /**
     * @param mixed $build_serial
     */
    public function setBuildSerial($build_serial): void
    {
        $this->build_serial = $build_serial;
    }

    /**
     * @return mixed
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param mixed $carrier
     */
    public function setCarrier($carrier): void
    {
        $this->carrier = $carrier;
    }

    /**
     * @return mixed
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param mixed $channel
     */
    public function setChannel($channel): void
    {
        $this->channel = $channel;
    }

    /**
     * @return mixed
     */
    public function getClientudid()
    {
        return $this->clientudid;
    }

    /**
     * @param mixed $clientudid
     */
    public function setClientudid($clientudid): void
    {
        $this->clientudid = $clientudid;
    }

    /**
     * @return mixed
     */
    public function getCpuAbi()
    {
        return $this->cpu_abi;
    }

    /**
     * @param mixed $cpu_abi
     */
    public function setCpuAbi($cpu_abi): void
    {
        $this->cpu_abi = $cpu_abi;
    }

    /**
     * @return mixed
     */
    public function getCustom()
    {
        return $this->custom;
    }

    /**
     * @param mixed $custom
     */
    public function setCustom($custom): void
    {
        $this->custom = $custom;
    }

    /**
     * @return int
     */
    public function getDeviceId(): int
    {
        return $this->device_id;
    }

    /**
     * @param int $device_id
     */
    public function setDeviceId(int $device_id): void
    {
        $this->device_id = $device_id;
    }

    /**
     * @return mixed
     */
    public function getDeviceBrand()
    {
        return $this->device_brand;
    }

    /**
     * @param mixed $device_brand
     */
    public function setDeviceBrand($device_brand): void
    {
        $this->device_brand = $device_brand;
    }

    /**
     * @return mixed
     */
    public function getDeviceManufacturer()
    {
        return $this->device_manufacturer;
    }

    /**
     * @param mixed $device_manufacturer
     */
    public function setDeviceManufacturer($device_manufacturer): void
    {
        $this->device_manufacturer = $device_manufacturer;
    }

    /**
     * @return mixed
     */
    public function getDeviceModel()
    {
        return $this->device_model;
    }

    /**
     * @param mixed $device_model
     */
    public function setDeviceModel($device_model): void
    {
        $this->device_model = $device_model;
    }

    /**
     * @return mixed
     */
    public function getDeviceType()
    {
        return $this->device_type;
    }

    /**
     * @param mixed $device_type
     */
    public function setDeviceType($device_type): void
    {
        $this->device_type = $device_type;
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * @param mixed $display_name
     */
    public function setDisplayName($display_name): void
    {
        $this->display_name = $display_name;
    }

    /**
     * @return mixed
     */
    public function getDisplayDensity()
    {
        return $this->display_density;
    }

    /**
     * @param mixed $display_density
     */
    public function setDisplayDensity($display_density): void
    {
        $this->display_density = $display_density;
    }

    /**
     * @return mixed
     */
    public function getDensityDpi()
    {
        return $this->density_dpi;
    }

    /**
     * @param mixed $density_dpi
     */
    public function setDensityDpi($density_dpi): void
    {
        $this->density_dpi = $density_dpi;
    }

    /**
     * @return mixed
     */
    public function getIdfa()
    {
        return $this->idfa;
    }

    /**
     * @param mixed $idfa
     */
    public function setIdfa($idfa): void
    {
        $this->idfa = $idfa;
    }

    /**
     * @return mixed
     */
    public function getInstallId()
    {
        return $this->install_id;
    }

    /**
     * @param mixed $install_id
     */
    public function setInstallId($install_id): void
    {
        $this->install_id = $install_id;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language): void
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getOpenudid()
    {
        return $this->openudid;
    }

    /**
     * @param mixed $openudid
     */
    public function setOpenudid($openudid): void
    {
        $this->openudid = $openudid;
    }

    /**
     * @return mixed
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * @param mixed $os
     */
    public function setOs($os): void
    {
        $this->os = $os;
    }

    /**
     * @return mixed
     */
    public function getOsApi()
    {
        return $this->os_api;
    }

    /**
     * @param mixed $os_api
     */
    public function setOsApi($os_api): void
    {
        $this->os_api = $os_api;
    }

    /**
     * @return mixed
     */
    public function getOsVersion()
    {
        return $this->os_version;
    }

    /**
     * @param mixed $os_version
     */
    public function setOsVersion($os_version): void
    {
        $this->os_version = $os_version;
    }

    /**
     * @return mixed
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * @param mixed $package
     */
    public function setPackage($package): void
    {
        $this->package = $package;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region): void
    {
        $this->region = $region;
    }

    /**
     * @return mixed
     */
    public function getSdkVersion()
    {
        return $this->sdk_version;
    }

    /**
     * @param mixed $sdk_version
     */
    public function setSdkVersion($sdk_version): void
    {
        $this->sdk_version = $sdk_version;
    }

    /**
     * @return int
     */
    public function getTimezone(): int
    {
        return $this->timezone;
    }

    /**
     * @param int $timezone
     */
    public function setTimezone(int $timezone): void
    {
        $this->timezone = $timezone;
    }

    /**
     * @return int
     */
    public function getTzOffset(): int
    {
        return $this->tz_offset;
    }

    /**
     * @param int $tz_offset
     */
    public function setTzOffset(int $tz_offset): void
    {
        $this->tz_offset = $tz_offset;
    }

    /**
     * @return string
     */
    public function getTzName(): string
    {
        return $this->tz_name;
    }

    /**
     * @param string $tz_name
     */
    public function setTzName(string $tz_name): void
    {
        $this->tz_name = $tz_name;
    }

    /**
     * @return mixed
     */
    public function getUdid()
    {
        return $this->udid;
    }

    /**
     * @param mixed $udid
     */
    public function setUdid($udid): void
    {
        $this->udid = $udid;
    }

    /**
     * @return mixed
     */
    public function getUserUniqueId()
    {
        return $this->user_unique_id;
    }

    /**
     * @param mixed $user_unique_id
     */
    public function setUserUniqueId($user_unique_id): void
    {
        $this->user_unique_id = $user_unique_id;
    }

    /**
     * @return mixed
     */
    public function getVendorId()
    {
        return $this->vendor_id;
    }

    /**
     * @param mixed $vendor_id
     */
    public function setVendorId($vendor_id): void
    {
        $this->vendor_id = $vendor_id;
    }

    /**
     * @return mixed
     */
    public function getClientIp()
    {
        return $this->client_ip;
    }

    /**
     * @param mixed $client_ip
     */
    public function setClientIp($client_ip): void
    {
        $this->client_ip = $client_ip;
    }

    /**
     * @return mixed
     */
    public function getUserUniqueIdType()
    {
        return $this->user_unique_id_type;
    }

    /**
     * @param mixed $user_unique_id_type
     */
    public function setUserUniqueIdType($user_unique_id_type): void
    {
        $this->user_unique_id_type = $user_unique_id_type;
    }

    public function jsonSerialize()
    {
        $data = [];
        if ($this->app_id != null && CollectorConfig::$env != MessageEnv::SAAS) {
            $data["app_id"] = $this->app_id;
            $data["aid"] = $this->app_id;
        }
        if ($this->app_language != null) $data["app_language"] = $this->app_language;
        if ($this->app_name != null) $data["app_name"] = $this->app_name;
        if ($this->app_region != null) $data["app_region"] = $this->app_region;
        if ($this->app_version != null) $data["app_version"] = $this->app_version;
        if ($this->app_version_minor != null) $data["app_version_minor"] = $this->app_version_minor;
        if ($this->client_ip != null) $data["client_ip"] = $this->client_ip;
        if ($this->app_key != null) $data["app_key"] = $this->app_key;
        if ($this->build_serial != null) $data["build_serial"] = $this->build_serial;
        if ($this->carrier != null) $data["carrier"] = $this->carrier;
        if ($this->channel != null) $data["channel"] = $this->channel;
        if ($this->clientudid != null) $data["clientudid"] = $this->clientudid;
        if ($this->cpu_abi != null) $data["cpu_abi"] = $this->cpu_abi;
        if ($this->custom != null) $data["custom"] = $this->custom;
        if ($this->device_id != null) $data["device_id"] = $this->device_id == 1 ? 0:$this->device_id;
        if ($this->device_brand != null) $data["device_brand"] = $this->device_brand;
        if ($this->device_manufacturer != null) $data["device_manufacturer"] = $this->device_manufacturer;
        if ($this->device_model != null) $data["device_model"] = $this->device_model;
        if ($this->device_type != null) $data["device_type"] = $this->device_type;
        if ($this->display_name != null) $data["display_name"] = $this->display_name;
        if ($this->display_density != null) $data["display_density"] = $this->display_density;
        if ($this->density_dpi != null) $data["density_dpi"] = $this->density_dpi;
        if ($this->idfa != null) $data["idfa"] = $this->idfa;
        if ($this->install_id != null) $data["install_id"] = $this->install_id;
        if ($this->language != null) $data["language"] = $this->language;
        if ($this->openudid != null) $data["openudid"] = $this->openudid;
        if ($this->os != null) $data["os"] = $this->os;
        if ($this->os_api != null) $data["os_api"] = $this->os_api;
        if ($this->os_version != null) $data["os_version"] = $this->os_version;
        if ($this->package != null) $data["package"] = $this->package;
        if ($this->region != null) $data["region"] = $this->region;
        if ($this->sdk_version != null) $data["sdk_version"] = $this->sdk_version;
        if ($this->timezone != null) $data["timezone"] = $this->timezone;
        if ($this->tz_offset != null) $data["tz_offset"] = $this->tz_offset;
        if ($this->tz_name != null) $data["tz_name"] = $this->tz_name;
        if ($this->udid != null) $data["udid"] = $this->udid;
        if ($this->user_unique_id != null) $data["user_unique_id"] = $this->user_unique_id;
        if ($this->vendor_id != null) $data["vendor_id"] = $this->vendor_id;
        if ($this->ssid != null) $data["ssid"] = $this->ssid;
        if ($this->anonymous_id != null) {
            $data["anonymous_id"] = $this->anonymous_id;
        }
        if($this->user_unique_id_type !=null){
            $data["user_unique_id_type"] = $this->user_unique_id_type;
        }
        return $data;
    }

}