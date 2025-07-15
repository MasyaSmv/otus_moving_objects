<?php

namespace App\Trait;

trait HasAngle
{
    private float $angle = 0;

    public function getAngle(): float
    {
        return $this->angle;
    }

    public function setAngle(float $angle): void
    {
        $this->angle = $angle;
    }
}
