<?php

namespace DataRangers\Sender;

use DataRangers\CollectorConfig;
use DataRangers\Model\Message\Message;

interface MessageSender
{
    /**
     * 真正发送
     * @param Message $message
     */
    public function send(Message $message);
}