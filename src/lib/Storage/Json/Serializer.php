<?php

declare(strict_types=1);

namespace BehaviorTree\Storage\Json;

use BehaviorTree\Contracts\Node\Composite\CompositeInterface;
use BehaviorTree\Contracts\Node\TaskInterface;

class Serializer
{
    public function serialize(CompositeInterface $composite): string
    {
        $compositeClassName = $this->getCompositeClassName($composite);
        $serializedChilds = $this->serializeChilds($composite->getChilds());
        return json_encode([
            'class_name' => $compositeClassName,
            'childs' => $serializedChilds,
        ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    }

    private function getCompositeClassName(CompositeInterface|TaskInterface $composite)
    {
        return get_class($composite);
    }

    private function serializeChilds(array $childs): array
    {
        $serialized = [];
        /** @var CompositeInterface $child */
        foreach ($childs as $child) {
            if ($child instanceof CompositeInterface) {
                $serialized[] = [
                    'class_name' => $this->getCompositeClassName($child),
                    'childs' => $this->serializeChilds($child->getChilds()),
                ];
                continue;
            }
            if ($child instanceof TaskInterface) {
                $serialized[] = [
                    'class_name' => $this->getCompositeClassName($child),
                ];
            }
        }
        return $serialized;
    }
}