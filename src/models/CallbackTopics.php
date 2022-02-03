<?php

namespace floor12\callback\models;

class CallbackTopics
{
    const TOPIC_DEFAULT = 0;

    public static $emails = [
        self::TOPIC_DEFAULT => ['example@localhost']
    ];

    public static $subjects = [
        self::TOPIC_DEFAULT => 'Callback request from web site'
    ];

    public function getTopicSubject($topicId): ?string
    {
        return $this::$subjects[$topicId];
    }

    public function getTopicEmails($topicId): ?array
    {
        return $this::$emails[$topicId];
    }
}