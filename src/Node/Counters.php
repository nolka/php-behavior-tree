<?php

namespace BehaviorTree\Node;

class Counters
{
    private int $executedNodesCount = 0;
    private int $executedDecoratorsCount = 0;

    public function increaseExecutedNodesCount(): int
    {
        $this->executedNodesCount++;
        return $this->getExecutedNodesCount();
    }

    public function increaseExecutedDecoratorsCount(): int
    {
        $this->executedDecoratorsCount++;
        return $this->getExecutedDecoratorsCount();
    }

    public function getExecutedNodesCount(): int
    {
        return $this->executedNodesCount;
    }

    public function getExecutedDecoratorsCount(): int
    {
        return $this->executedDecoratorsCount;
    }
}