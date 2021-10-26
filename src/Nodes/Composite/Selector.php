<?php

declare(strict_types=1);

namespace BehaviorTree\Nodes\Composite;


use BehaviorTree\Nodes\AbstractNode;
use BehaviorTree\Nodes\Result\Failure;
use BehaviorTree\Nodes\Result\Success;

/**
 * Run tasks continuously until them returns true
 */
class Selector extends AbstractNode
{
    public function execute(): Success|Failure
    {
        foreach ($this->getChilds() as $child) {
            if (($result = $child->execute()) instanceof Success) {
                return $result;
            }
        }
        return new Failure();
    }
}