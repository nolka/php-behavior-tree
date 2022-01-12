<?php

declare(strict_types=1);

namespace BehaviorTree\Event;


use BehaviorTree\BehaviorTree;
use BehaviorTree\Contracts\Event\EventInterface;

class Event implements EventInterface
{
    private BehaviorTree $behaviorTree;

    public function __construct(
        private mixed $sender,
        private mixed $payload,
    )
    {
    }

    public function getPayload(): mixed
    {
        return $this->payload;
    }

    public function getSender(): mixed
    {
        return $this->sender;
    }

    public function setBehaviorTree(BehaviorTree $behaviorTree): void
    {
        $this->behaviorTree = $behaviorTree;
    }

    public function getBehaviorTree(): BehaviorTree
    {
        return $this->behaviorTree;
    }
}