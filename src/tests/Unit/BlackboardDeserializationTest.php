<?php

namespace BehaviorTree\Tests\Unit;

use BehaviorTree\Blackboard\Test\TestBadBlackboard;
use BehaviorTree\Blackboard\Test\TestBlackboard;
use BehaviorTree\Exceptions\PropertyNotExistException;
use BehaviorTree\Exceptions\PropertyTypeNotSupportedException;
use PHPUnit\Framework\TestCase;
use stdClass;

class BlackboardDeserializationTest extends TestCase
{
    public function testFullDeserialization()
    {
        $intValue = 400;
        $stringValue = 'some string value';
        $boolValue = false;
        $arrayValue = ['a' => 'b'];

        $input = [
            'intValue' => $intValue,
            'stringValue' => $stringValue,
            'boolValue' => $boolValue,
            'arrayValue' => $arrayValue,
        ];

        $blackboard = new TestBlackboard();
        $blackboard->load($input);

        $this->assertEquals($intValue, $blackboard->intValue);
        $this->assertEquals($stringValue, $blackboard->stringValue);
        $this->assertEquals($boolValue, $blackboard->boolValue);
        $this->assertEquals($arrayValue, $blackboard->arrayValue);
    }

    public function testPartialDeserialization()
    {
        $intValue = 500;
        $stringValue = 'some some string value';

        $input = [
            'intValue' => $intValue,
            'stringValue' => $stringValue,
        ];

        $blackboard = new TestBlackboard();
        $blackboard->load($input);

        $this->assertEquals($intValue, $blackboard->intValue);
        $this->assertEquals($stringValue, $blackboard->stringValue);
        $this->assertEquals(true, $blackboard->boolValue);
        $this->assertEquals([], $blackboard->arrayValue);
    }

    public function testMissingPropertyExceptionDeserialization()
    {
        $input = [
            'anotherProperty' => 'value',
        ];

        $this->expectException(PropertyNotExistException::class);

        $blackboard = new TestBlackboard();
        $blackboard->load($input);
    }

    public function testUnsupportedPropertyExceptionDeserialization()
    {
        $blackboard = new TestBadBlackboard();
        $this->expectException(PropertyTypeNotSupportedException::class);
        $blackboard->load(['property' => new stdClass()]);
    }

}