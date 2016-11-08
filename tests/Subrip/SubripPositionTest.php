<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 07.11.2016
 * Time: 21:41
 */

namespace Mattwoo\Subrip\Test;


use Mattwoo\Subrip\SubripPosition;

class SubripPositionTest extends \PHPUnit_Framework_TestCase
{

    public function testToString()
    {
        $pos = new SubripPosition(101, 201, 301, 401);
        $res = $pos->__toString();
        $expected = ' X1:101 X2:201 Y1:301 Y2:401';
        $this->assertEquals($expected, $res);
    }

    public function testCreateFromFile()
    {
        $content = <<<CONTENT
1
00:00:00.000 --> 00:00:10.000 X1:100 X2:200 Y1:100 Y2:200
text
CONTENT;

        /** @var SubripPosition $position */
        $position = SubripPosition::createFromFile($content);
        $this->assertInstanceOf(SubripPosition::class, $position);
        $this->assertEquals(100, $position->getX1());
        $this->assertEquals(200, $position->getX2());
        $this->assertEquals(100, $position->getY1());
        $this->assertEquals(200, $position->getY2());

    }

}
