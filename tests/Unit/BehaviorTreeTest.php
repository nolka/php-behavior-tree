<?php

namespace BehaviorTree\Tests\Unit;

use BehaviorTree\BehaviorTree;
use BehaviorTree\Events\Event;
use BehaviorTree\Nodes\BehaviorTreeRoot;
use BehaviorTree\Nodes\Composite\Selector;
use BehaviorTree\Nodes\Composite\Sequence;
use BehaviorTree\Nodes\Tasks\Task1;
use BehaviorTree\Nodes\Tasks\Task2;
use BehaviorTree\Storage\Json\Deserializer;
use BehaviorTree\Storage\Json\Serializer;
use PHPUnit\Framework\TestCase;

class BehaviorTreeTest extends TestCase
{

    public function testSelector()
    {
        $composite = new Selector();
        $composite->appendChild(new Task1());
        $composite->appendChild(new Task2());

        $behaviorTreeRoot = new BehaviorTreeRoot();
        $behaviorTreeRoot->setComposite($composite);

        $bt = new BehaviorTree();
//        $bt->play(new Event(), $behaviorTreeRoot);
        $this->assertTrue(true);
    }

    public function testSequence()
    {
        $composite = new Sequence();
        $composite->appendChild(new Task1());
        $composite->appendChild(new Task2());

        $composite2 = new Selector();
        $composite2->appendChild(new Task2());

        $composite->appendChild($composite2);

        $behaviorTreeRoot = new BehaviorTreeRoot();
        $behaviorTreeRoot->setComposite($composite);

        $bt = new BehaviorTree();
        $bt->play(new Event(), $behaviorTreeRoot);
        $this->assertTrue(true);
    }

    public function testSerializer()
    {
        $composite = new Sequence();
        $composite->appendChild(new Task1());
        $composite->appendChild(new Task2());

        $composite2 = new Selector();
        $composite2->appendChild(new Task2());

        $composite->appendChild($composite2);

        $behaviorTreeRoot = new BehaviorTreeRoot();
        $behaviorTreeRoot->setComposite($composite);

        $serializer = new Serializer();
        $actualJson = $serializer->serialize($composite);
        $expectedJson = '{"class_name":"BehaviorTree\\\\Nodes\\\\Composite\\\\Sequence","childs":[{"class_name":"BehaviorTree\\\\Nodes\\\\Tasks\\\\Task1"},{"class_name":"BehaviorTree\\\\Nodes\\\\Tasks\\\\Task2"},{"class_name":"BehaviorTree\\\\Nodes\\\\Composite\\\\Selector","childs":[{"class_name":"BehaviorTree\\\\Nodes\\\\Tasks\\\\Task2"}]}]}';

        $this->assertEquals($expectedJson, $actualJson);
    }

    public function testDeserializer()
    {
        $jsonData = '{"class_name":"BehaviorTree\\\\Nodes\\\\Composite\\\\Sequence","childs":[{"class_name":"BehaviorTree\\\\Nodes\\\\Tasks\\\\Task1"},{"class_name":"BehaviorTree\\\\Nodes\\\\Tasks\\\\Task2"},{"class_name":"BehaviorTree\\\\Nodes\\\\Composite\\\\Selector","childs":[{"class_name":"BehaviorTree\\\\Nodes\\\\Tasks\\\\Task2"}]}]}';

        $deserializer = new Deserializer();
        $composite = $deserializer->deserialize($jsonData);
        $this->assertTrue($composite->getChilds()[0] instanceof Task1);
        $this->assertTrue($composite->getChilds()[1] instanceof Task2);
        $this->assertTrue($composite->getChilds()[2] instanceof Selector);
        $this->assertTrue($composite->getChilds()[2]->getChilds()[0] instanceof Task2);
    }
}