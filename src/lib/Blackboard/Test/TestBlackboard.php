<?php

declare(strict_types=1);

namespace BehaviorTree\Blackboard\Test;

use BehaviorTree\Blackboard\AbstractBlackboard;

class TestBlackboard extends AbstractBlackboard
{
    public int $intValue = 1;
    public string $stringValue = 'stringValue';
    public bool $boolValue = true;
    public array $arrayValue = [];
}