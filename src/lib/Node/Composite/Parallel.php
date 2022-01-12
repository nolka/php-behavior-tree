<?php

declare(strict_types=1);

namespace BehaviorTree\Node\Composite;


use BehaviorTree\Contracts\Event\EventInterface;
use BehaviorTree\Node\AbstractNode;
use BehaviorTree\Node\Result\Failure;
use BehaviorTree\Node\Result\Success;

class Parallel extends AbstractNode
{
    public function execute(EventInterface $event): Success|Failure
    {
        throw new \Exception('Paralles composite is not yet implemented!');
    }
}