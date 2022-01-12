<?php

declare(strict_types=1);

namespace BehaviorTree\Node\Decorator\Test;

use BehaviorTree\Contracts\Event\EventInterface;
use BehaviorTree\Contracts\Node\Decorator\DecoratorInterface;

class TaskCanBeExecutedDecorator implements DecoratorInterface
{
    public function canExecute(EventInterface $event): bool
    {
        return true;
    }
}