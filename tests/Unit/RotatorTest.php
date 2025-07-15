<?php

namespace Tests\Unit;

use App\Contract\Rotatable;
use App\Service\Rotator;
use PHPUnit\Framework\TestCase;

class RotatorTest extends TestCase
{
    public function testRotatePositive(): void
    {
        $obj = new class implements Rotatable {
            private float $angle = 30;

            public function getAngle(): float
            {
                return $this->angle;
            }

            public function setAngle(float $angle): void
            {
                $this->angle = $angle;
            }
        };
        (new Rotator())->rotate($obj, 45);
        $this->assertSame(75.0, $obj->getAngle());
    }

    public function testRotateWrapsAround360(): void
    {
        $obj = new class implements Rotatable {
            private float $angle = 350;

            public function getAngle(): float
            {
                return $this->angle;
            }

            public function setAngle(float $angle): void
            {
                $this->angle = $angle;
            }
        };
        (new Rotator())->rotate($obj, 20);
        $this->assertSame(10.0, $obj->getAngle());
    }

    public function testRotateNegativeDelta(): void
    {
        $obj = new class implements Rotatable {
            private float $angle = 10;

            public function getAngle(): float
            {
                return $this->angle;
            }

            public function setAngle(float $angle): void
            {
                $this->angle = $angle;
            }
        };
        (new Rotator())->rotate($obj, -30);
        $this->assertSame(340.0, $obj->getAngle());
    }

    public function testMissingMethodsTypeError(): void
    {
        $this->expectException(\TypeError::class);
        $broken = new class {
            // нет Rotatable
        };
        
        /** @psalm-suppress InvalidArgument */
        (new Rotator())->rotate($broken, 10.0);
    }
}
