<?php

namespace Geekor\Core\Support;

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
class ApiEventConstant
{
    // HTTP STAUS

    // =================================================================
    //   CODE DEFINE
    // =================================================================
    const SUCCESS = '1000';

    //------------------------------------------
    const JUST_FAILED = '4000';
    const API_REQ_ERROR = '4002';
    const API_PARAM_MISS  = '4003';
    const UNAUTHENTICATED = '4010';
    const FORBIDDEN = '4030';
    const NOT_FOUND = '4040';
    const SERVER_ERROR = '5000';

    // === MESSAGE ======================================================
    const _MSGS_ = [
        //... MISC
        '1000' => 'SUCCESS',

        // ---------------- ERROR ----------------------
        '4000' => 'SEE_DETAIL',
        '4001' => 'API_REQUEST_ERROR',
        '4002' => 'API_PARAM_MISS',
        '4010' => 'UNAUTHENTICATED',
        '4030' => 'FORBIDDEN',
        '4040' => 'NOT_FOUND',

        '5000' => 'SERVER_ERROR',
    ];

    // =================================================================
    //   FUNCTIONS
    // =================================================================

    public static function msg($code) {
        $k = self::_MSGS_[$code];
        return trans($k);
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
            'code' => (int)$code,
            'message' => 'Error',
            'detail' => [],
        ];

        if (Arr::has(self::_MSGS_, $code)) {
            $resp['message'] = self::msg($code);
        }

        if ($detail !== null) {
            $resp['detail'] = $detail;
        }

        return response()->json($resp, $status);
    }

    // 认证失败
    public static function failx401($detail = null)
    {
        return self::failx(self::UNAUTHENTICATED, $detail, 401);
    }

    // 禁止访问（没有权限）
    public static function failx403($detail = null)
    {
        return self::failx(self::FORBIDDEN, $detail, 403);
    }

    // 没找到指定对象
    public static function failx404($detail = null)
    {
        return self::failx(self::NOT_FOUND, $detail, 404);
    }

    public static function failx500($detail = null)
    {
        return self::failx(self::SERVER_ERROR, $detail, 500);
    }
}
