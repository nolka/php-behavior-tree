<?php

declare(strict_types=1);

namespace BehaviorTree\Node\Composite;


use BehaviorTree\Node\AbstractNode;
use BehaviorTree\Node\Result\Failure;
use BehaviorTree\Node\Result\Success;

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