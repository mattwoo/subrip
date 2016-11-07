<?php
/**
 * This file is a part of subrip package
 * (c) Mateusz Westwalewicz <vu.mateusz@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mattwoo\Subrip\Test;


use Mattwoo\Subrip\SubripFile;
use Mattwoo\Subrip\SubripRow;

class SubripFileTest extends \PHPUnit_Framework_TestCase
{

    public function testSingleToString()
    {
        $row = new SubripRow(1, '00:00:00,010', '00:00:00,012', 'test');
        $file = new SubripFile();
        $file->addRow($row);
        $res = $file->__toString();

        $expected = <<<EXPECTED
1
00:00:00,010 --> 00:00:00,012
test


EXPECTED;

        $this->assertEquals($expected, $res);

    }


    public function testMultipleToString()
    {
        $row = new SubripRow(1, '00:00:00,010', '00:00:00,012', 'test');
        $file = new SubripFile();
        $file->addRow($row);
        $file->addRow($row);
        $res = $file->__toString();

        $expected = <<<EXPECTED
1
00:00:00,010 --> 00:00:00,012
test

1
00:00:00,010 --> 00:00:00,012
test


EXPECTED;

        $this->assertEquals($expected, $res);

    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionOnFileNotFound()
    {
        $obj = new SubripFile('');
    }

}
