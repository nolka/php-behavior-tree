<?php

declare(strict_types=1);

namespace BehaviorTree\Events;


use BehaviorTree\Contracts\Events\EventInterface;

class Event implements EventInterface
{
    public function getPayload(): mixed
    {
        // TODO: Implement getPayload() method.
    }
}