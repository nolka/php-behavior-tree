<?php

declare(strict_types=1);

namespace BehaviorTree\Node\Composite;


use BehaviorTree\Contracts\Event\EventInterface;
use BehaviorTree\Node\AbstractNode;
use BehaviorTree\Node\Result\Failure;
use BehaviorTree\Node\Result\Success;

class Sequence extends AbstractNode
{
    public function execute(EventInterface $event): Success|Failure
    {
        foreach ($this->getChilds() as $child) {
            foreach ($child->getDecorators() as $decorator) {
                $event->getBehaviorTree()->getBehaviorTreeRoot()->getCounters()?->increaseExecutedDecoratorsCount();
                if (!$decorator->canExecute($event)) {
                    break;
                }
            }
            $result = $child->execute($event);
            $event->getBehaviorTree()->getBehaviorTreeRoot()->getCounters()?->increaseExecutedNodesCount();
            if ($result instanceof Failure) {
                return $result;
            }
        }
        return new Success();
    }
}