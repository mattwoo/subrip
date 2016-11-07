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
        $expected = 'X1:101 X2:201 Y1:301 Y2:401';
        $this->assertEquals($expected, $res);
    }

}
