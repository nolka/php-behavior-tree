<?php

namespace BehaviorTree\Tests\Unit;

use BehaviorTree\BehaviorTree;
use BehaviorTree\Event\Event;
use BehaviorTree\Node\BehaviorTreeRoot;
use BehaviorTree\Node\Composite\Selector;
use BehaviorTree\Node\Composite\Sequence;
use BehaviorTree\Node\Counters;
use BehaviorTree\Node\Decorator\Test\TaskCanBeExecutedDecorator;
use BehaviorTree\Node\Decorator\Test\TaskCannotBeExecutedDecorator;
use BehaviorTree\Node\Task\Test\TaskSuccess;
use BehaviorTree\Node\Task\Test\TaskFailure;
use BehaviorTree\Storage\Json\Deserializer;
use BehaviorTree\Storage\Json\Serializer;
use PHPUnit\Framework\TestCase;

class BehaviorTreeTest extends TestCase
{

    public function testSelector()
    {
        $composite = new Selector();
        $composite->appendChild(new TaskSuccess());
        $composite->appendChild(new TaskFailure());

        $behaviorTreeRoot = new BehaviorTreeRoot();
        $behaviorTreeRoot->setComposite($composite);

        $bt = new BehaviorTree('test tree', null);
        $bt->play(new Event($this, null), $behaviorTreeRoot);
        $this->assertTrue(true);
    }

    public function testSequence()
    {
        $composite = new Sequence();
        $composite->appendChild(new TaskSuccess());
        $composite->appendChild(new TaskFailure());

        $composite2 = new Selector();
        $composite2->appendChild(new TaskFailure());

        $composite->appendChild($composite2);

        $behaviorTreeRoot = new BehaviorTreeRoot();
        $behaviorTreeRoot->setComposite($composite);

        $bt = new BehaviorTree('test tree', null);
        $bt->play(new Event($this, null), $behaviorTreeRoot);
        $this->assertTrue(true);
    }

    public function testTaskCanBeExecutedWithDecorator()
    {
        $composite = new Selector();

        $task = new TaskSuccess();
        $task->appendDecorator(new TaskCanBeExecutedDecorator());

        $composite->appendChild($task);
        $composite->appendChild(new TaskSuccess());

        $behaviorTreeRoot = new BehaviorTreeRoot(new Counters());
        $behaviorTreeRoot->setComposite($composite);

        $bt = new BehaviorTree('test tree', null);
        $bt->play(new Event($this, null), $behaviorTreeRoot);
        $this->assertEquals(1, $bt->getBehaviorTreeRoot()->getCounters()->getExecutedDecoratorsCount());
        $this->assertEquals(1, $bt->getBehaviorTreeRoot()->getCounters()->getExecutedNodesCount());
    }

    public function testTaskCannotBeExecutedWithDecorator()
    {
        $composite = new Selector();
        $task = new TaskSuccess();
        $task->appendDecorator(new TaskCannotBeExecutedDecorator());
        $composite->appendChild($task);
        $composite->appendChild(new TaskFailure());

        $behaviorTreeRoot = new BehaviorTreeRoot(new Counters());
        $behaviorTreeRoot->setComposite($composite);

        $bt = new BehaviorTree('test tree', null);
        $bt->play(new Event($this, null), $behaviorTreeRoot);
        $this->assertEquals(1, $bt->getBehaviorTreeRoot()->getCounters()->getExecutedDecoratorsCount());
        $this->assertEquals(1, $bt->getBehaviorTreeRoot()->getCounters()->getExecutedNodesCount());
    }

    public function testSerializer()
    {
        $composite = new Sequence();
        $composite->appendChild(new TaskSuccess());
        $composite->appendChild(new TaskFailure());

        $composite2 = new Selector();
        $composite2->appendChild(new TaskFailure());

        $composite->appendChild($composite2);

        $behaviorTreeRoot = new BehaviorTreeRoot();
        $behaviorTreeRoot->setComposite($composite);

        $serializer = new Serializer();
        $actualJson = $serializer->serialize($composite);
        $expectedJson = '{"class_name":"BehaviorTree\\\\Node\\\\Composite\\\\Sequence","childs":[{"class_name":"BehaviorTree\\\\Node\\\\Task\\\\Test\\\\TaskSuccess"},{"class_name":"BehaviorTree\\\\Node\\\\Task\\\\Test\\\\TaskFailure"},{"class_name":"BehaviorTree\\\\Node\\\\Composite\\\\Selector","childs":[{"class_name":"BehaviorTree\\\\Node\\\\Task\\\\Test\\\\TaskFailure"}]}]}';

        $this->assertEquals($expectedJson, $actualJson);
    }

    public function testDeserializer()
    {
        $jsonData = '{"class_name":"BehaviorTree\\\\Node\\\\Composite\\\\Sequence","childs":[{"class_name":"BehaviorTree\\\\Node\\\\Task\\\\Test\\\\TaskSuccess"},{"class_name":"BehaviorTree\\\\Node\\\\Task\\\\Test\\\\TaskFailure"},{"class_name":"BehaviorTree\\\\Node\\\\Composite\\\\Selector","childs":[{"class_name":"BehaviorTree\\\\Node\\\\Task\\\\Test\\\\TaskFailure"}]}]}';

        $deserializer = new Deserializer();
        $composite = $deserializer->deserialize($jsonData);
        $this->assertTrue($composite->getChilds()[0] instanceof TaskSuccess);
        $this->assertTrue($composite->getChilds()[1] instanceof TaskFailure);
        $this->assertTrue($composite->getChilds()[2] instanceof Selector);
        $this->assertTrue($composite->getChilds()[2]->getChilds()[0] instanceof TaskFailure);
    }
}