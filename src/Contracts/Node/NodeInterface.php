<?php

declare(strict_types=1);

namespace BehaviorTree\Contracts\Node;

use BehaviorTree\Node\Result\Failure;
use BehaviorTree\Node\Result\Success;

interface NodeInterface
{
    public function execute(): Success|Failure;
}