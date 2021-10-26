<?php

declare(strict_types=1);

namespace BehaviorTree\Contracts\Events;


interface EventInterface
{
    public function getPayload(): mixed;
}