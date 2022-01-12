<?php

declare(strict_types=1);

namespace BehaviorTree\Blackboard\Test;

use BehaviorTree\Blackboard\AbstractBlackboard;
use stdClass;

class TestBadBlackboard extends AbstractBlackboard
{
    public ?stdClass $property = null;
}