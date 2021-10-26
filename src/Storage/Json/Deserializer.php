<?php

namespace BehaviorTree\Storage\Json;

use BehaviorTree\Contracts\Nodes\Composite\CompositeInterface;
use BehaviorTree\Contracts\Nodes\TaskInterface;

class Deserializer
{
    public function deserialize(string $serializedBehaviorTree): CompositeInterface
    {
        $decodedData = json_decode($serializedBehaviorTree, true, flags: JSON_THROW_ON_ERROR);
        return $this->buildComposite($decodedData['class_name'], $decodedData['childs']);
    }

    private function buildComposite(string $compositeClassName, array $childs): CompositeInterface
    {
        /** @var CompositeInterface $composite */
        $composite = new $compositeClassName();
        /** @var array{class_name: string, childs:array} $child */
        foreach ($childs as $child) {
            $childClassName = $child['class_name'];
            if (key_exists(CompositeInterface::class, class_implements($childClassName))) {
                $composite->appendChild($this->buildComposite($childClassName, $child['childs']));
                continue;
            }
            if (key_exists(TaskInterface::class, class_implements($childClassName))) {
                $composite->appendChild(new $childClassName());
            }
        }
        return $composite;
    }
}