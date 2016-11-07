<?php
/**
 * This file is a part of subrip package
 * (c) Mateusz Westwalewicz <vu.mateusz@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mattwoo\Subrip\Test;

use Mattwoo\Subrip\SubripRow;
use PHPUnit\Framework\TestCase;

class SubripRowTest extends TestCase
{

    /**
     * @expectedException \Mattwoo\Subrip\SubripValidationException
     */
    public function testThrowsExceptionOnInvalidStartTimeFormat()
    {
        $row = new SubripRow(1,'asd', '00:00:00,000', 'asd');
        $row->validate();
    }

    /**
     * @expectedException \Mattwoo\Subrip\SubripValidationException
     */
    public function testThrowsExceptionOnInvalidEndTimeFormat()
    {
        $row = new SubripRow(1,'00:00:00,000', 'asd', 'test');
        $row->validate();
    }

    /**
     * @expectedException \Mattwoo\Subrip\SubripValidationException
     */
    public function testThrowsExceptionOnEmptyText()
    {
        $row = new SubripRow(1,'asd', 'asd', '');
        $row->validate();
    }

    public function testReturnsTrueOnValidTime(){
        $row = new SubripRow(1,'00:00:00,000', '00:00:00,000', 'text');
        $res = $row->validate();
        $this->assertTrue($res);
    }

    public function testToString(){
        $row = new SubripRow(1,'00:00:00,000', '01:01:01,001', 'test');
        $res = $row->__toString();

        $expected = <<<EXPECTED
1
00:00:00,000 --> 01:01:01,001
test


EXPECTED;

        $this->assertEquals($expected, $res);

    }

}
