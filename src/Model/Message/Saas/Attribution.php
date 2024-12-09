<?php

namespace DataRangers\Model\Message\Saas;

class Attribution implements \JsonSerializable
{
    private string $name;
    private $value;
    private string $operation;

    public function __construct($name, $value, $operation)
    {
        $this->name = $name;
        $this->value = $value;
        $this->operation = $operation;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * @param string $operation
     */
    public function setOperation(string $operation): void
    {
        $this->operation = $operation;
    }


    public function jsonSerialize()
    {
        $data = [];
        if ($this->name != null) {
            $data["name"] = $this->name;
        }
        if ($this->value !== null) {
            $data["value"] = $this->value;
        }
        if ($this->operation != null) {
            $data["operation"] = $this->operation;
        }
        return $data;
    }
}