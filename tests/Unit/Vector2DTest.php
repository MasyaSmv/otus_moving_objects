<?php

namespace Tests\Unit;

use App\ValueObject\Vector2D;
use PHPUnit\Framework\TestCase;

class Vector2DTest extends TestCase
{
    public function testGetComponents(): void
    {
        $v = new Vector2D(1.5, -2.5);
        $this->assertSame(1.5, $v->getX());
        $this->assertSame(-2.5, $v->getY());
    }

    public function testAddCreatesNewVector(): void
    {
        $v1 = new Vector2D(2.0, 3.0);
        $v2 = new Vector2D(-1.0, 1.0);
        $sum = $v1->add($v2);

        $this->assertInstanceOf(Vector2D::class, $sum);
        $this->assertSame(1.0, $sum->getX());
        $this->assertSame(4.0, $sum->getY());
    }

    public function testWithXAndWithYCloneCorrectly(): void
    {
        $v = new Vector2D(0.0, 5.0);
        $v2 = $v->withX(10.0);
        $this->assertNotSame($v, $v2);
        $this->assertSame(10.0, $v2->getX());
        $this->assertSame(5.0, $v2->getY());

        $v3 = $v->withY(-7.0);
        $this->assertNotSame($v, $v3);
        $this->assertSame(0.0, $v3->getX());
        $this->assertSame(-7.0, $v3->getY());
    }
}
