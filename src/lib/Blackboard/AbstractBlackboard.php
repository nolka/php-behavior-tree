<?php

declare(strict_types=1);

namespace BehaviorTree\Blackboard;

use BehaviorTree\Contracts\Blackboard\BlackboardInterface;
use BehaviorTree\Exceptions\PropertyNotExistException;
use BehaviorTree\Exceptions\PropertyTypeNotSupportedException;
use ReflectionClass;
use ReflectionException;

class AbstractBlackboard implements BlackboardInterface
{
    public function load(array $blackboardData): void
    {
        $this->deserialize($this, $blackboardData);
    }

    public function save(): array
    {
        $serialized = [];
        foreach ($this as $property => $value) {
            $serialized[$property] = $value;
        }
        return $serialized;
    }

    private function deserialize(mixed $subject, array $blackboardData): void
    {
        $reflectionClass = new ReflectionClass($this);
        foreach ($blackboardData as $property => $value) {
            if (!is_scalar($value) && !is_array($value)) {
                throw new PropertyTypeNotSupportedException("The property {$property} has unsupported value type: " . gettype($value));
            }
            try {
                $propertyInstance = $reflectionClass->getProperty($property);
                $deserializedValue = match ($propertyInstance->getType()->getName()) {
                    'string' => (string)$value,
                    'int' => intval($value),
                    'bool' => boolval($value),
                    'array' => $value,
                };
                $subject->$property = $deserializedValue;
            } catch (ReflectionException $e) {
                throw new PropertyNotExistException($property);
            }
        }
    }

}