<?php

namespace BehaviorTree\Node;

use BehaviorTree\Contracts\Event\EventInterface;
use BehaviorTree\Contracts\Node\Composite\CompositeInterface;

class BehaviorTreeRoot
{
    private CompositeInterface $composite;

    public function __construct(
        private ?Counters $counters = null,
    )
    {
    }

    public function execute(EventInterface $event): void
    {
        $this->composite->execute($event);
    }

    public function setComposite(CompositeInterface $composite)
    {
        $this->composite = $composite;
    }

    public function getComposite(): CompositeInterface
    {
        return $this->composite;
    }

    public function getCounters(): ?Counters
    {
        return $this->counters;
    }
}