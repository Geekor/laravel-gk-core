<?php

namespace Geekor\Core\Support;

use Illuminate\Support\Carbon;

class GkTime
{

/** -------------------------------------------------------
 *   时间戳转换
 *  ------------------------------------------------------- */

    /**
     * 日期+时间 字符串 => 时间戳
     */
    public static function datetimeStringToTimestamp($text)
    {
        return (new Carbon($text))->timestamp;
    }

    /**
     * 时间戳 => 日期+时间 字符串
     */
    public static function timestampToDatetimeString($ts)
    {
        if ('0.0' == $ts) {
            return (Carbon::createFromTimestampUTC('0'))->toDateTimeString();
        } else {
            $len = strlen($ts);
            if ($len >= 13) {
                $ts = substr($ts, 0, $len-3);
            }
            return (Carbon::createFromTimestampUTC($ts))->toDateTimeString();
        }
    }

    /**
     * 时间戳 => 日期 字符串
     */
    public static function timestampToDateString($ts)
    {
        if ('0.0' == $ts) {
            return (Carbon::createFromTimestampUTC('0'))->toDateTimeString();
        } else {
            $len = strlen($ts);
            if ($len >= 13) {
                $ts = substr($ts, 0, $len-3);
            }
            return (Carbon::createFromTimestampUTC($ts))->toDateString();
        }
    }

    /**
     * 修改时区
     */
    public static function fixTimezone($time, $tz=8)
    {
        $carbon = Carbon::parse($time);
        $carbon->addHours($tz);
        return $carbon->toDateTimeString();
    }
}
