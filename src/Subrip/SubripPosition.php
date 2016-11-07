<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 07.11.2016
 * Time: 21:34
 */

namespace Mattwoo\Subrip;


class SubripPosition implements SubripStyleInterface
{

    const SUBRIP_POSITION_REGEX = '/X1:[0-9]+ X2:[0-9]+ Y1:[0-9]+ Y2:[0-9]+/';

    private $x1, $x2, $y1, $y2;

    /**
     * SubripPosition constructor.
     * @param $x1
     * @param $x2
     * @param $y1
     * @param $y2
     */
    public function __construct($x1, $x2, $y1, $y2)
    {
        $this->x1 = $x1;
        $this->x2 = $x2;
        $this->y1 = $y1;
        $this->y2 = $y2;
        $args = func_get_args();
        array_walk($args, function ($value) {
            if (!is_int($value)) {
                throw new \InvalidArgumentException(sprintf('%s:%s parameters must be integers.', __CLASS__, __METHOD__));
            }
        });
    }

    public function __toString()
    {
        return sprintf('X1:%d X2:%d Y1:%d Y2:%d', $this->x1, $this->x2, $this->y1, $this->y2);
    }

    public static function createFromFile($content){
        preg_match_all(self::SUBRIP_POSITION_REGEX, $content, $matched);
        if(count($matched) == 0){
            return null;
        }
        return new SubripPosition($matched[1][0],$matched[2][0],$matched[3][0],$matched[4][0]);
    }

}