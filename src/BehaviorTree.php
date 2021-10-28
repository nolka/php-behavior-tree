<?php

declare(strict_types=1);

namespace BehaviorTree;


use BehaviorTree\Contracts\Event\EventInterface;
use Node\BehaviorTreeRoot;

class BehaviorTree
{
    public function __construct()
    {
    }

    public function play(EventInterface $event, BehaviorTreeRoot $behaviorTreeRoot)
    {
        $this->prepareBehaviorTree($event);
        $this->runBehaviorTree($event, $behaviorTreeRoot);
        $this->save();
    }

    private function prepareBehaviorTree(EventInterface $event)
    {

    }

    private function runBehaviorTree(EventInterface $event, BehaviorTreeRoot $behaviorTreeRoot)
    {
        $behaviorTreeRoot->execute();
    }

    private function save()
    {

    }
}