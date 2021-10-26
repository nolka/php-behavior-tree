<?php

declare(strict_types=1);

namespace BehaviorTree\Nodes;


use BehaviorTree\Contracts\Nodes\TaskInterface;
use BehaviorTree\Nodes\Result\Failure;
use BehaviorTree\Nodes\Result\Success;

abstract class AbstractTask implements TaskInterface
{
    abstract public function execute(): Success|Failure;
}