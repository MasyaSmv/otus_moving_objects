<?php

namespace App\Trait;

use App\ValueObject\Vector2D;

trait HasPosition
{
    private Vector2D $position;

    public function getPosition(): Vector2D
    {
        return $this->position;
    }

    public function setPosition(Vector2D $position): void
    {
        $this->position = $position;
    }
}
