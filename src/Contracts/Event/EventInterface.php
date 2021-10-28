<?php

declare(strict_types=1);

namespace BehaviorTree\Contracts\Event;


use BehaviorTree\BehaviorTree;

interface EventInterface
{
    public function getPayload(): mixed;

    public function getSender(): mixed;

    public function setBehaviorTree(BehaviorTree $behaviorTree): void;

    public function getBehaviorTree(): BehaviorTree;
}