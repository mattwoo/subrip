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

    const FILE_REGEX = '/([0-9]+)(?:\r\n|\r|\n)([0-9]{2}:[0-9]{2}:[0-9]{2}(?:,|\.)[0-9]{3}) --> ([0-9]{2}:[0-9]{2}:[0-9]{2}(?:,|\.)[0-9]{3})(.*)(?:\r\n|\r|\n)((?:.*(?:\r\n|\r|\n))*?)(?:\r\n|\r|\n)/';

    private $rows = [];

    /**
     * SubripFile constructor.
     * @param null $content
     */
    public function __construct($content = null)
    {
        if (null !== $content) {
            if (empty($content)) {
                throw new \InvalidArgumentException('Content is empty');
            }
            $this->parseFile($content);
        }
    }

    /**
     * @param $content
     * @return SubripFile
     * @throws SubripValidationException
     */
    private function parseFile($content)
    {
        preg_match_all(self::FILE_REGEX, $content, $matched);
        if (count($matched) == 0) {
            throw new SubripValidationException('Invalid file format.');
        }
        $lastSeqNumber = 0;
        for ($i = 0; $i < count($matched[0]); $i++) {
            $seqNumber = $matched[1][$i];
            if ($seqNumber <= $lastSeqNumber) {
                throw new SubripValidationException('Sequence numbers are not growing.');
            }
            $styles = SubripPosition::createFromFile($matched[0][$i]);
            $row = new SubripRow($matched[1][$i], $matched[2][$i], $matched[3][$i], $matched[5][$i], $styles);
            $this->addRow($row);
            $lastSeqNumber = $seqNumber;
        }
        return $this;
    }

    public function getRows()
    {
        return $this->rows;
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