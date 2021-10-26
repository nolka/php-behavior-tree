<?php

declare(strict_types=1);

namespace BehaviorTree\Contracts\Nodes;

use BehaviorTree\Nodes\Result\Failure;
use BehaviorTree\Nodes\Result\Success;

interface NodeInterface
{
    public function execute(): Success|Failure;
}