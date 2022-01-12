<?php

declare(strict_types=1);

namespace BehaviorTree\Contracts\Node\Decorator;


use BehaviorTree\Contracts\Event\EventInterface;

interface DecoratorInterface
{
    public function canExecute(EventInterface $event): bool;
}