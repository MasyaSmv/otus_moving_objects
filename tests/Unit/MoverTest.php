<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Service\Mover;
use App\ValueObject\Vector2D;
use App\Contract\Positionable;
use App\Contract\VelocityAware;
use TypeError;

class MoverTest extends TestCase
{
    public function testMoveChangesPosition(): void
    {
        // создаём двойник с начальными значениями
        $obj = new class(
            new Vector2D(12, 5),
            new Vector2D(-7, 3)
        ) implements Positionable, VelocityAware {
            private Vector2D $pos;
            private Vector2D $vel;

            public function __construct(Vector2D $pos, Vector2D $vel)
            {
                $this->pos = $pos;
                $this->vel = $vel;
            }

            public function getPosition(): Vector2D { return $this->pos; }
            public function setPosition(Vector2D $position): void { $this->pos = $position; }
            public function getVelocity(): Vector2D   { return $this->vel; }
        };

        $mover = new Mover();
        $mover->move($obj);

        $this->assertEquals(new Vector2D(5, 8), $obj->getPosition());
    }

    public function testMoveMissingPositionableThrows(): void
    {
        $this->expectException(TypeError::class);

        // Объект без Positionable::getPosition()
        $broken = new class implements VelocityAware {
            public function getVelocity(): Vector2D
            {
                return new Vector2D(1, 1);
            }
        };
        
        /** @psalm-suppress InvalidArgument */
        (new Mover())->move($broken);
    }
}
