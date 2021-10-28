<?php

namespace BehaviorTree\Node\Decorator\Test;

use BehaviorTree\Contracts\Event\EventInterface;
use BehaviorTree\Contracts\Node\Decorator\DecoratorInterface;

class TaskCannotBeExecutedDecorator implements DecoratorInterface
{
    public function canExecute(EventInterface $event): bool
    {
        return false;
    }
}