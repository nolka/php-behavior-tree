<?php

declare(strict_types=1);

namespace BehaviorTree\Contracts\Nodes\Composite;


use BehaviorTree\Contracts\Nodes\NodeInterface;
use BehaviorTree\Nodes\AbstractTask;

interface CompositeInterface
{
    public function appendChild(NodeInterface|AbstractTask $child): void;

    public function getChilds(): array;
}