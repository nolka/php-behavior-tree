<?php

declare(strict_types=1);

namespace BehaviorTree;


use BehaviorTree\Contracts\Event\EventInterface;
use BehaviorTree\Node\BehaviorTreeRoot;

class BehaviorTree
{
    private BehaviorTreeRoot $behaviorTreeRoot;

    public function __construct(
        private string $name,
    )
    {
    }

    public function play(EventInterface $event, BehaviorTreeRoot $behaviorTreeRoot): void
    {
        $this->prepareBehaviorTree($event, $behaviorTreeRoot);
        $this->runBehaviorTree($event, $behaviorTreeRoot);
    }

    private function prepareBehaviorTree(EventInterface $event, BehaviorTreeRoot $behaviorTreeRoot): void
    {
        $this->behaviorTreeRoot = $behaviorTreeRoot;
        $event->setBehaviorTree($this);
    }

    private function runBehaviorTree(EventInterface $event, BehaviorTreeRoot $behaviorTreeRoot): void
    {
        $behaviorTreeRoot->execute($event);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBehaviorTreeRoot(): BehaviorTreeRoot
    {
        return $this->behaviorTreeRoot;
    }
}