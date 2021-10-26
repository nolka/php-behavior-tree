<?php

declare(strict_types=1);

namespace BehaviorTree\Nodes\Composite;


use BehaviorTree\Nodes\AbstractNode;
use BehaviorTree\Nodes\Result\Failure;
use BehaviorTree\Nodes\Result\Success;

class Parallel extends AbstractNode
{
    public function execute(): Success|Failure
    {
        throw new \Exception('Paralles composite is not yet implemented!');
    }
}