<?php
/**
 * This file is a part of subrip project
 * (c) Mateusz Westwalewicz <vu.mateusz@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mattwoo\Subrip;


class SubripFile
{

    const FILE_REGEX = '/[0-9]+(?:\r\n|\r|\n)([0-9]{2}:[0-9]{2}:[0-9]{2}(?:,|\.)[0-9]{3}) --> ([0-9]{2}:[0-9]{2}:[0-9]{2}(?:,|\.)[0-9]{3})(?:\r\n|\r|\n)((?:.*(?:\r\n|\r|\n))*?)(?:\r\n|\r|\n)/';

    private $rows = [];

    public function __construct($path = null)
    {
        if (null !== $path) {
            if (!file_exists($path)) {
                throw new \InvalidArgumentException(sprintf('File: %s does not exist.', $path));
            }
            $this->createFromFile(file_get_contents($path));
        }
    }

    private function createFromFile($content){
        preg_match_all(self::FILE_REGEX, $content, $matched);
        if(count($matched) == 0) {
            throw new SubripValidationException('Invalid file format.');
        }
        foreach($matched as $item){
            print_r($item);
        }
    }

    /**
     * @param SubripRow $row
     */
    public function addRow(SubripRow $row)
    {
        $this->rows[] = $row;
    }

    /**
     * @param array $rows
     */
    public function setRows(array $rows)
    {
        $this->rows = $rows;
    }

    public function __toString()
    {
        $out = '';
        array_walk($this->rows, function (SubripRow $value) use (&$out) {
            $out .= $value->__toString();
        });
        return $out;
    }
}