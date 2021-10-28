<?php

declare(strict_types=1);

namespace BehaviorTree\Node\Composite;


use BehaviorTree\Node\AbstractNode;
use BehaviorTree\Node\Result\Failure;
use BehaviorTree\Node\Result\Success;

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