<?php

namespace BehaviorTree\Node;

use BehaviorTree\Contracts\Node\Composite\CompositeInterface;
use BehaviorTree\Contracts\Node\NodeInterface;
use BehaviorTree\Node\Result\Failure;
use BehaviorTree\Node\Result\Success;

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