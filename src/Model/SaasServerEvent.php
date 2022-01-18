<?php

namespace DataRangers\Model;

class SaasServerEvent implements \JsonSerializable
{
    private string $event;
    private string $params;
    private string $sessionId;
    private int $localTimeMs;
    private string $datetime;
    private ?string $abSdkVersion;

    public function __construct(Event $event)
    {
        $this->setEvent($event->getEvent());
        $params = $event->getParams();
        if ($event->getItems() != null) {
            $params['__items'] = array_values($event->getItems());
        }
        $this->setParams(json_encode($params));
        $this->setSessionId($event->getEvent());
        $this->setLocalTimeMs($event->getLocalTimeMs());
        $this->setDatetime($event->getDateTime());
        $this->setAbSdkVersion($event->getAbSdkVersion());
    }

    /**
     * @return string
     */
    public function getEvent(): string
    {
        return $this->event;
    }

    /**
     * @param string $event
     */
    public function setEvent(string $event): void
    {
        $this->event = $event;
    }

    /**
     * @return string
     */
    public function getParams(): string
    {
        return $this->params;
    }

    /**
     * @param string $params
     */
    public function setParams(string $params): void
    {
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * @param string $sessionId
     */
    public function setSessionId(string $sessionId): void
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @return int
     */
    public function getLocalTimeMs(): int
    {
        return $this->localTimeMs;
    }

    /**
     * @param int $localTimeMs
     */
    public function setLocalTimeMs(int $localTimeMs): void
    {
        $this->localTimeMs = $localTimeMs;
    }

    /**
     * @return string
     */
    public function getDatetime(): string
    {
        return $this->datetime;
    }

    /**
     * @param string $datetime
     */
    public function setDatetime(string $datetime): void
    {
        $this->datetime = $datetime;
    }

    /**
     * @return string
     */
    public function getAbSdkVersion(): ?string
    {
        return $this->abSdkVersion;
    }

    /**
     * @param ?string $abSdkVersion
     */
    public function setAbSdkVersion(?string $abSdkVersion): void
    {
        $this->abSdkVersion = $abSdkVersion;
    }


    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        $data = [];
        if ($this->event != null) {
            $data["event"] = $this->event;
        }
        if ($this->params != null) {
            $data["params"] = $this->params;
        }
        if ($this->sessionId != null) {
            $data["session_id"] = $this->sessionId;
        }
        if ($this->localTimeMs != null) {
            $data["local_time_ms"] = $this->localTimeMs;
        }
        if ($this->datetime != null) {
            $data["datatime"] = $this->datetime;
        }
        if ($this->abSdkVersion != null) {
            $data["ab_sdk_version"] = $this->abSdkVersion;
        }

        return $data;
    }
}