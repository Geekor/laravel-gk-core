<?php

namespace Geekor\Core;

/**
 * use Geekor\Core\AppConst as GK;
 *
 * GK::tr('xxx');
 *
 */
class AppConst
{
    public const LANG_NAMESPACE = 'gk-core';

    //========================================

    public static function tr($key = null, $replace = [], $locale = null)
    {
        return trans(self::LANG_NAMESPACE . '::' . $key, $replace, $locale);
    }
}
