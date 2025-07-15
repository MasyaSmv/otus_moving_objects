<?php

namespace App\Trait;

use App\ValueObject\Vector2D;

trait HasVelocity
{
    private Vector2D $velocity;

    public function getVelocity(): Vector2D
    {
        return $this->velocity;
    }
}
