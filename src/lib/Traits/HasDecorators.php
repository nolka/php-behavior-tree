<?php

declare(strict_types=1);

namespace BehaviorTree\Traits;


use BehaviorTree\Contracts\Node\Decorator\DecoratorInterface;

trait HasDecorators
{
    /** @var array DecoratorInterface[] */
    private array $decorators = [];


    public function appendDecorator(DecoratorInterface $decorator): void
    {
        $this->decorators[] = $decorator;
    }

    /**
     * @return DecoratorInterface[]
     */
    public function getDecorators(): array
    {
        return $this->decorators;
    }
}