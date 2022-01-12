<?php

namespace BehaviorTree\Node;

use BehaviorTree\Contracts\Event\EventInterface;
use BehaviorTree\Contracts\Node\Composite\CompositeInterface;
use BehaviorTree\Contracts\Node\HasDecoratorInterface;
use BehaviorTree\Contracts\Node\NodeInterface;
use BehaviorTree\Node\Result\Failure;
use BehaviorTree\Node\Result\Success;
use BehaviorTree\Traits\HasDecorators;

abstract class AbstractNode implements CompositeInterface, NodeInterface, HasDecoratorInterface
{
    use HasDecorators;

    /** @var AbstractNode[] */
    private array $childs = [];

    public abstract function execute(EventInterface $event): Success|Failure;

    public function appendChild(NodeInterface|AbstractTask $child): void
    {
        $this->childs[] = $child;
    }

    public function getChilds(): array
    {
        return $this->childs;
    }
}