<?php

namespace DataRangers\Sender;

use DataRangers\CollectorConfig;
use DataRangers\Model\Message\Message;

interface MessageSender
{
    /**
     * 真正发送
     * @param Message $message
     * @return void
     */
    public function send(Message $message): void;
}