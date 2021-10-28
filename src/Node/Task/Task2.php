<?php

declare(strict_types=1);

namespace BehaviorTree\Node\Task;


use BehaviorTree\Node\AbstractTask;
use BehaviorTree\Node\Result\Failure;
use BehaviorTree\Node\Result\Success;

class Task2 extends AbstractTask
{
    public function execute(): Success|Failure
    {
        echo "Task 2\n";
        return (int)microtime(true) % 2 == 0 ? new Success() : new Failure();
    }
}