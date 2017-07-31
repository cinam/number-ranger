<?php

namespace Cinam\NumberRanger\Tests;

use Cinam\NumberRanger\Ranger;

class RangerTest extends \PHPUnit\Framework\TestCase
{
    public function testTinyRange()
    {
        $ranger = new Ranger(1, 1, 0);
        $this->assertEquals([1], $ranger->getRangeWithBoundaries(1));

        $ranger = new Ranger(1, 1, 1);
        $this->assertEquals([1], $ranger->getRangeWithBoundaries(1));

        $ranger = new Ranger(1, 2, 0);
        $this->assertEquals([1, 2], $ranger->getRangeWithBoundaries(1));

        $ranger = new Ranger(1, 2, 0);
        $this->assertEquals([1, 2], $ranger->getRangeWithBoundaries(2));
    }

    public function testSmallRange()
    {
        $ranger = new Ranger(-1, 1, 0);
        $this->assertEquals([-1, '...', 1], $ranger->getRangeWithBoundaries(-1));
        $this->assertEquals([-1, 0, 1], $ranger->getRangeWithBoundaries(0));
        $this->assertEquals([-1, '...', 1], $ranger->getRangeWithBoundaries(1));

        $ranger = new Ranger(-1, 1, 1);
        $this->assertEquals([-1, 0, 1], $ranger->getRangeWithBoundaries(-1));
        $this->assertEquals([-1, 0, 1], $ranger->getRangeWithBoundaries(0));
        $this->assertEquals([-1, 0, 1], $ranger->getRangeWithBoundaries(1));

        $ranger = new Ranger(-2, 2, 1);
        $this->assertEquals([-2, -1, '...', 2], $ranger->getRangeWithBoundaries(-2));
        $this->assertEquals([-2, -1, 0, '...', 2], $ranger->getRangeWithBoundaries(-1));
        $this->assertEquals([-2, -1, 0, 1, 2], $ranger->getRangeWithBoundaries(0));
        $this->assertEquals([-2, '...', 0, 1, 2], $ranger->getRangeWithBoundaries(1));

        $ranger = new Ranger(-2, 2, 2);
        $this->assertEquals([-2, -1, 0, '...', 2], $ranger->getRangeWithBoundaries(-2));
        $this->assertEquals([-2, -1, 0, 1, 2], $ranger->getRangeWithBoundaries(-1));
        $this->assertEquals([-2, -1, 0, 1, 2], $ranger->getRangeWithBoundaries(0));
        $this->assertEquals([-2, -1, 0, 1, 2], $ranger->getRangeWithBoundaries(1));
        $this->assertEquals([-2, '...', 0, 1, 2], $ranger->getRangeWithBoundaries(2));
    }

    public function testLargeRange()
    {
        $ranger = new Ranger(1, 15, 2);
        $this->assertEquals([1, 2, 3, 4, 5, '...', 15], $ranger->getRangeWithBoundaries(3));
        $this->assertEquals([1, 2, 3, 4, 5, 6, '...', 15], $ranger->getRangeWithBoundaries(4));
        $this->assertEquals([1, '...', 3, 4, 5, 6, 7, '...', 15], $ranger->getRangeWithBoundaries(5));
        $this->assertEquals([1, '...', 8, 9, 10, 11, 12, '...', 15], $ranger->getRangeWithBoundaries(10));
        $this->assertEquals([1, '...', 9, 10, 11, 12, 13, '...', 15], $ranger->getRangeWithBoundaries(11));
        $this->assertEquals([1, '...', 10, 11, 12, 13, 14, 15], $ranger->getRangeWithBoundaries(12));
        $this->assertEquals([1, '...', 11, 12, 13, 14, 15], $ranger->getRangeWithBoundaries(13));
    }

    public function testSizeGreaterThanRange()
    {
        $ranger = new Ranger(-1, 1, 5);
        $this->assertEquals([-1, 0, 1], $ranger->getRangeWithBoundaries(-1));
        $this->assertEquals([-1, 0, 1], $ranger->getRangeWithBoundaries(0));
        $this->assertEquals([-1, 0, 1], $ranger->getRangeWithBoundaries(1));
    }
}
