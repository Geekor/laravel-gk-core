<?php

namespace Geekor\Core;

/**
 * use Geekor\Core\Consts as GK;
 *
 * GK::tr('xxx');
 *
 */
class Consts
{
    public const LANG_NAMESPACE = 'geekor-core';

    //========================================

    public static function tr($key = null, $replace = [], $locale = null)
    {
        return trans(self::LANG_NAMESPACE . '::' . $key, $replace, $locale);
    }
}
