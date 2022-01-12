<?php

namespace BehaviorTree\Contracts\Blackboard;

interface BlackboardInterface
{
    public function load(array $blackboardData): void;

    public function save(): array;
}