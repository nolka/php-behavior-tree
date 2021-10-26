<?php

declare(strict_types=1);

namespace BehaviorTree\Nodes\Tasks;


use BehaviorTree\Nodes\AbstractTask;
use BehaviorTree\Nodes\Result\Failure;
use BehaviorTree\Nodes\Result\Success;

class Task1 extends AbstractTask
{
    public function execute(): Success|Failure
    {
        echo "Task 1\n";
        return (int)microtime(true) % 2 == 0? new Success(): new Failure();
    }
}