<?php

namespace Geekor\Core\Support;

use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;

class GkTestUtil
{
    /**
     * 如果返回的是 json / 二维数组， 则可以通过 getKey 参数从数组中获取数据
     * getKey 可以是  foo.bar 的链式结构
     */
    public static function getResponseContent(TestResponse $resp, $getKey = null)
    {
        $arr = $resp->baseResponse->getOriginalContent();
        if (is_array($arr) && ! empty($getKey)) {
            return Arr::get($arr, $getKey);
        }

        return $arr;
    }
}
