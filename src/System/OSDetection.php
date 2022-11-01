<?php declare(strict_types=1);

namespace Tkui\System;

use Tkui\Exceptions\UnsupportedOSException;

class OSDetection
{
    public static function detect(): OS
    {
        return match (strtolower(PHP_OS_FAMILY)) {
            'windows'   => new Windows(),
            'linux'     => new Linux(),
            default     => throw new UnsupportedOSException(),
        };
    }
}
