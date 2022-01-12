<?php

declare(strict_types=1);

namespace BehaviorTree\Node\Task\Test;


use BehaviorTree\Contracts\Event\EventInterface;
use BehaviorTree\Node\AbstractTask;
use BehaviorTree\Node\Result\Failure;
use BehaviorTree\Node\Result\Success;

class TaskSuccess extends AbstractTask
{
    public function execute(EventInterface $event): Success|Failure
    {
        return new Success();
    }
}