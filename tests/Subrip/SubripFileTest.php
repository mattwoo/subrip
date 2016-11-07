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
use Mattwoo\Subrip\SubripValidationException;

class SubripFileTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \Mattwoo\Subrip\SubripValidationException
     */
    public function testThrowsExceptionOnNotGrowingSequenceNumbers()
    {

        $fileContent = <<<CONTENT
1
00:00:00,010 --> 00:00:00,012 X1:100 X2:200 Y1:100 Y2:200
test


2
00:00:00,013 --> 00:00:00,022
test


2
00:00:00,023 --> 00:00:00,033
test


CONTENT;

        $file = new SubripFile($fileContent);

    }

    public function testCreateFromFile()
    {
        $fileContent = <<<CONTENT
1
00:00:00,010 --> 00:00:00,012
test


2
00:00:00,013 --> 00:00:00,022
test


3
00:00:00,023 --> 00:00:00,033
test


CONTENT;

        $file = new SubripFile($fileContent);
        $this->assertInstanceOf(SubripFile::class, $file);
        $this->assertTrue(is_array($file->getRows()));
        foreach ($file->getRows() as $row) {
            $this->assertInstanceOf(SubripRow::class, $row);
        }

    }

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
    public function testThrowsExceptionOnEmptyFile()
    {
        $obj = new SubripFile('');
    }

}
