<?php
/**
 * This file is a part of subrip package
 * (c) Mateusz Westwalewicz <vu.mateusz@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__ . '/../vendor/autoload.php';

$content = file_get_contents(__DIR__.'/subtitles.srt');

$file = new \Mattwoo\Subrip\SubripFile($content);

echo '<pre>';

echo $file->__toString();