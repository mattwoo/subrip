<?php
/**
 * This file is a part of subrip package
 * (c) Mateusz Westwalewicz <vu.mateusz@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mattwoo\Subrip;


class SubripRow
{

    const TIME_REGEX = '/^[0-9]{2}\:[0-9]{2}\:[0-9]{2}\,[0-9]{1,3}$/';

    private $sequence;
    private $startTime;
    private $endTime;
    private $text;
    private $styles;

    /**
     * SubripRow constructor.
     * @param $startTime
     * @param $sequence
     * @param $endTime
     * @param $text
     * @param $styles
     */
    public function __construct($sequence, $startTime, $endTime, $text, SubripStyleInterface $styles = null)
    {
        $this->sequence = $sequence;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->text = $text;
        $this->styles = $styles;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @param mixed $endTime
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @param SubripStyleInterface $styles
     */
    public function setStyles(SubripStyleInterface $styles = null)
    {
        $this->styles = $styles;
    }

    public function setSequence($sequence)
    {
        $this->sequence = $sequence;
    }

    /**
     * @return mixed
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return SubripStyleInterface
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * @throws SubripValidationException
     */
    public function validate()
    {
        if (!preg_match(self::TIME_REGEX, $this->startTime)) {
            throw new SubripValidationException(sprintf('Start time must match regular expression: %s', self::TIME_REGEX));
        }
        if (!preg_match(self::TIME_REGEX, $this->endTime)) {
            throw new SubripValidationException(sprintf('Start time must match regular expression: %s', self::TIME_REGEX));
        }
        if (empty($this->text)) {
            throw new SubripValidationException('Text must not be null');
        }
        return true;
    }

    public function __toString()
    {
        $styles = $this->styles instanceof SubripStyleInterface ? $this->styles->__toString() : '';
        return $this->sequence . PHP_EOL .
        $this->startTime . ' --> ' . $this->endTime . $styles . PHP_EOL .
        $this->text . PHP_EOL . PHP_EOL;
    }

}