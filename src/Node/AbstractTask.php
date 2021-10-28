<?php

declare(strict_types=1);

namespace BehaviorTree\Node;


use BehaviorTree\Contracts\Event\EventInterface;
use BehaviorTree\Contracts\Node\HasDecoratorInterface;
use BehaviorTree\Contracts\Node\TaskInterface;
use BehaviorTree\Traits\HasDecorators;
use BehaviorTree\Node\Result\Failure;
use BehaviorTree\Node\Result\Success;

abstract class AbstractTask implements TaskInterface, HasDecoratorInterface
{
    use HasDecorators;

    abstract public function execute(EventInterface $event): Success|Failure;
}