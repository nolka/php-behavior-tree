<?php

declare(strict_types=1);

namespace BehaviorTree\Nodes\Composite;


use BehaviorTree\Nodes\AbstractNode;
use BehaviorTree\Nodes\Result\Failure;
use BehaviorTree\Nodes\Result\Success;

class Sequence extends AbstractNode
{
    public function execute(): Success|Failure
    {
        foreach ($this->getChilds() as $child) {
            if (($result = $child->execute()) instanceof Failure) {
                return $result;
            }
        }
        return new Success();
    }
}