<?php

namespace Geekor\Core\Support;

use Geekor\Core\Consts as GK;
use Illuminate\Support\Arr;

/**
 * How to use?
 * --------------------------
 * use Geekor\Core\Support\GkApi as Api;
 *
 * Api::success();
 * Api::success(['time' => '2018-11-20 12:00:00']);
 *
 * Api::fail();
 * Api::fail('说明');
 * Api::failx(Api::API_PARAM_MISS, '详细信息');
 * Api::failx(Api::API_PARAM_MISS, '详细信息', 401);
 */
class GkApi
{
    // HTTP STAUS

    // =================================================================
    //   CODE DEFINE
    // =================================================================
    const SUCCESS = 1000;

    //------------------------------------------
    const JUST_FAILED = 4000;
    const API_REQUEST_ERROR = 4002;
    const API_PARAM_MISS  = 4004;
    const API_PARAM_ERROR  = 4005;
    const UNAUTHENTICATED = 4010;
    const FORBIDDEN = 4030;
    const NOT_FOUND = 4040;
    const METHOD_NOT_ALLOWED = 4050;
    const TOO_MANY_REQUESTS = 4290;

    const SERVER_ERROR = 5000;



    // === MESSAGE ======================================================
    const _MSGS_ = [
        //... MISC
        1000 => 'api.SUCCESS',

        // ---------------- ERROR ----------------------
        4000 => 'api.SEE_DETAIL',
        4002 => 'api.API_REQUEST_ERROR',
        4004 => 'api.API_PARAM_MISS',
        4005 => 'api.API_PARAM_ERROR',
        4010 => 'api.UNAUTHENTICATED',
        4030 => 'api.FORBIDDEN',
        4040 => 'api.NOT_FOUND',
        4050 => 'api.METHOD_NOT_ALLOWED',
        4290 => 'api.TOO_MANY_REQUESTS',

        5000 => 'api.SERVER_ERROR',
    ];

    // =================================================================
    //   FUNCTIONS
    // =================================================================

    public static function msg($code) {
        $k = self::_MSGS_[$code];

        return GK::tr($k);
    }

    public static function success($data = null, $status=200)
    {
        $resp = [];

        if ($data !== null) {
            $resp = $data;
        }

        return response()->json($resp, $status);
    }

    /**
     * 创建成功（状态码：201）
     */
    public static function successCreated($data = null)
    {
        return self::success($data, 201);
    }

    /**
     * 删除成功（状态码：204）
     */
    public static function successDeleted()
    {
        return self::success([], 204);
    }

    // ===================================================== FAILED ====

    public static function fail($detail=null, $status = 400)
    {
        return self::failx(self::JUST_FAILED, $detail, $status);
    }

    public static function failx($code, $detail = null, $status = 400)
    {
        $resp = [
            'code' => $code,
            'message' => 'Error',
            'detail' => '',
        ];

        if (Arr::has(self::_MSGS_, $code)) {
            $resp['message'] = self::msg($code);
        }

        if ($detail !== null) {
            $resp['detail'] = $detail;
        }

        return response()->json($resp, $status);
    }

    /**
     * 认证失败
     */
    public static function failxUnauthenticated($detail = null)
    {
        return self::failx(self::UNAUTHENTICATED, $detail, 401);
    }

    /**
     * 禁止访问（没有权限）
     */
    public static function failxForbidden($detail = null)
    {
        return self::failx(self::FORBIDDEN, $detail, 403);
    }

    /**
     * 没找到指定对象
     */
    public static function failxNotFound($detail = null)
    {
        return self::failx(self::NOT_FOUND, $detail, 404);
    }

    /**
     *  方法错误
     */
    public static function failxBadMethod($detail = null)
    {
        return self::failx(self::METHOD_NOT_ALLOWED, $detail, 405);
    }

    /**
     * 请求过于频繁
     */
    public static function failxTooManyRequsts($detail = null)
    {
        return self::failx(self::TOO_MANY_REQUESTS, $detail, 429);
    }

    public static function failxServerError($detail = null)
    {
        return self::failx(self::SERVER_ERROR, $detail, 500);
    }
}
