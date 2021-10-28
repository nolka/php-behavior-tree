<?php

declare(strict_types=1);

namespace BehaviorTree\Node;


use BehaviorTree\Contracts\Node\TaskInterface;
use BehaviorTree\Node\Result\Failure;
use BehaviorTree\Node\Result\Success;

abstract class AbstractTask implements TaskInterface
{
    abstract public function execute(): Success|Failure;
}