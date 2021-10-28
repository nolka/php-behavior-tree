<?php

declare(strict_types=1);

namespace BehaviorTree\Contracts\Event;


interface EventInterface
{
    public function getPayload(): mixed;
}