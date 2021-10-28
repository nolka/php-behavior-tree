<?php

namespace BehaviorTree\Node;

use BehaviorTree\Contracts\Node\Composite\CompositeInterface;

class BehaviorTreeRoot
{
    /** @var CompositeInterface[] */
    private CompositeInterface $composite;

    public function execute(): void
    {
        $this->composite->execute();
    }

    public function setComposite(CompositeInterface $composite)
    {
        $this->composite = $composite;
    }

    public function getComposite(): array
    {
        return $this->composite;
    }
}