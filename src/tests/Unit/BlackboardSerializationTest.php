<?php

namespace BehaviorTree\Tests\Unit;

use BehaviorTree\Blackboard\Test\TestBadBlackboard;
use BehaviorTree\Blackboard\Test\TestBlackboard;
use BehaviorTree\Exceptions\PropertyNotExistException;
use BehaviorTree\Exceptions\PropertyTypeNotSupportedException;
use PHPUnit\Framework\TestCase;
use stdClass;

class BlackboardSerializationTest extends TestCase
{
    public function testFullSerialization()
    {
        $intValue =   400;
        $stringValue = 'some string value';
        $boolValue = false;
        $arrayValue = ['c' => 'd'];

        $blackboard = new TestBlackboard();
        $blackboard->intValue =   $intValue;
        $blackboard->stringValue = $stringValue;
        $blackboard->boolValue = $boolValue;
        $blackboard->arrayValue = $arrayValue;

        $input = [
            'intValue' => $intValue,
            'stringValue' => $stringValue,
            'boolValue' => $boolValue,
            'arrayValue' => $arrayValue,
        ];

        $saved = $blackboard->save();

        $this->assertEquals($input, $saved);
    }

    public function testPartialSerialization()
    {
        $blackboard = new TestBlackboard();

        $intValue =   400;
        $stringValue = 'some string value';
        $boolValue = $blackboard->boolValue;
        $arrayValue = $blackboard->arrayValue;

        $blackboard->intValue =   $intValue;
        $blackboard->stringValue = $stringValue;

        $input = [
            'intValue' => $intValue,
            'stringValue' => $stringValue,
            'boolValue' => $boolValue,
            'arrayValue' => $arrayValue,
        ];

        $saved = $blackboard->save();

        $this->assertEquals($input, $saved);
    }
}