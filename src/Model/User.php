<?php
namespace DataRangers\Model;

class User implements \JsonSerializable{
    private String $userUniqueId;

    /**
     * @return String
     */
    public function getUserUniqueId(): string
    {
        return $this->userUniqueId;
    }

    /**
     * @param String $userUniqueId
     */
    public function setUserUniqueId(string $userUniqueId): void
    {
        $this->userUniqueId = $userUniqueId;
    }

    public function jsonSerialize()
    {
        $data = [];
        if ($this->userUniqueId != null) $data["user_unique_id"] = $this->userUniqueId;
        return $data;
    }
}