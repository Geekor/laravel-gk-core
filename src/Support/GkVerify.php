<?php

namespace Geekor\Core\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GkVerify
{
    /**
     * 检测输入参数是否有误
     * -----------------
     *
     * https://learnku.com/docs/laravel/9.x/validation/12219#560293
     *
     * 示例：
     * GkVerify::checkRequestFailed($request, [
     *     'email' => 'required|email',
     *     'password' => 'required',
     * ]);
     *
     * @param  Request  $request
     * @param  Array   $rules
     * @return boolean
     */
    public static function checkRequestFailed(Request $request, Array $rules)
    {
        return Validator::make($request->all(), $rules)->fails();
    }

    /**
     * 生成哈希密码
     * -----------
     *
     * @param  string   $txt
     * @return boolean
     */
    public static function makeHash(string $txt): string
    {
        return Hash::make($txt);
    }

    /**
     * 哈希密钥验证 (用户认证检查之类)
     *
     * @param  string  $src 没经过 hash 加密的原文
     * @param  string   $dst 经过 hash 加密后的密文
     * @return boolean
     */
    public static function checkHash(string $src, string $dst): string
    {
        return Hash::check($src, $dst);
    }
}
