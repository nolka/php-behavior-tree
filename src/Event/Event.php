<?php

declare(strict_types=1);

namespace BehaviorTree\Event;


use BehaviorTree\Contracts\Event\EventInterface;

class Event implements EventInterface
{
    public function getPayload(): mixed
    {
        // TODO: Implement getPayload() method.
    }
}