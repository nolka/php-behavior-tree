<?php

namespace BehaviorTree\Contracts\Blackboard;

interface BlackboardInterface
{
    public function load(string $blackboardData): void;

    public function save(): string;
}