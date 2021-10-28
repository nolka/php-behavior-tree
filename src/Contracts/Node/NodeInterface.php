<?php

declare(strict_types=1);

namespace BehaviorTree\Contracts\Node;

use BehaviorTree\Contracts\Event\EventInterface;
use BehaviorTree\Node\Result\Failure;
use BehaviorTree\Node\Result\Success;

interface NodeInterface
{
    public function execute(EventInterface $event): Success|Failure;
}