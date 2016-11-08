<?php
/**
 * This file is a part of subrip package
 * (c) Mateusz Westwalewicz <vu.mateusz@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__ . '/../vendor/autoload.php';

$position = new \Mattwoo\Subrip\SubripPosition(100, 200, 100, 200);
$row = new \Mattwoo\Subrip\SubripRow(1, '00:00:00.000', '00:00:10.000', 'text', $position);
$row2 = new \Mattwoo\Subrip\SubripRow(2, '00:00:00.000', '00:00:10.000', 'text', $position);
$file = new \Mattwoo\Subrip\SubripFile();
$file->addRow($row);
$file->addRow($row2);
?>
<pre><?= nl2br($file->__toString()); ?></pre>
