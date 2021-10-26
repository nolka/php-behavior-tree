<?php

namespace BehaviorTree\Nodes;

use BehaviorTree\Contracts\Nodes\Composite\CompositeInterface;
use BehaviorTree\Contracts\Nodes\NodeInterface;
use BehaviorTree\Nodes\Result\Failure;
use BehaviorTree\Nodes\Result\Success;

abstract class AbstractNode implements NodeInterface, CompositeInterface
{
    /** @var AbstractNode[] */
    private array $childs = [];

    public abstract function execute(): Success|Failure;

    public function appendChild(NodeInterface|AbstractTask $child): void
    {
        $this->childs[] = $child;
    }

    public function getChilds(): array
    {
        return $this->childs;
    }
}