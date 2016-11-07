<?php
/**
 * This file is a part of subrip package
 * (c) Mateusz Westwalewicz <vu.mateusz@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mattwoo\Subrip;

class SubripValidationException extends \Exception
{
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}