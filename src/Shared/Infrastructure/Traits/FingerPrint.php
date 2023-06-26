<?php

namespace App\Src\Shared\Infrastructure\Traits;

trait FingerPrint
{
    protected static string $seed = '2Mcv*KeduWFsyIGYRlKs';

    public static function stamp(array $parts)
    {
        $fingerPrint = '';
        foreach ($parts as $part)
        {
            $fingerPrint .= md5(sprintf('%s - ', $part));
        }
        return md5($fingerPrint);
    }
}
