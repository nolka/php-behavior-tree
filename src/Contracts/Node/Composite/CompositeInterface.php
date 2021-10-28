<?php

declare(strict_types=1);

namespace BehaviorTree\Contracts\Node\Composite;


use BehaviorTree\Contracts\Node\NodeInterface;
use BehaviorTree\Node\AbstractTask;

interface CompositeInterface
{
    public function appendChild(NodeInterface|AbstractTask $child): void;

    public function getChilds(): array;
}