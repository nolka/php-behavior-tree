<?php

declare(strict_types=1);

namespace BehaviorTree\Contracts\Node;


use BehaviorTree\Contracts\Node\Decorator\DecoratorInterface;

interface HasDecoratorInterface
{
    public function appendDecorator(DecoratorInterface $decorator): void;

    public function getDecorators(): array;
}