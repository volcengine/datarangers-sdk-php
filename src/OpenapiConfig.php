<?php
namespace DataRangers;

class OpenapiConfig
{
    private string $domain;
    private string $ak;
    private string $sk;

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function sedDomain($domain): void
    {
        $this->domain = $domain;
    }

    public function getAk(): string
    {
        return $this->ak;
    }

    public function setAk($ak): void
    {
        $this->ak = $ak;
    }

    /**
     * @return string
     */
    public function getSk(): string
    {
        return $this->sk;
    }

    /**
     * @param string $sk
     */
    public function setSk(string $sk): void
    {
        $this->sk = $sk;
    }

}