<?php

namespace Geekor\Core\Exceptions;

use Exception;
use Geekor\Core\Consts as GK;

/**
 * 用户没有某个 APP 的访问权限
 */
class AppAccessException extends Exception
{
    protected $status = 401;
    protected $message = 'no access permission';

    public function __construct($message = null, $status = 401)
    {
        $this->status = $status;

        if (empty($message)) {
            // 写在这里主要是为了翻译（没法写在上面）
            $this->message = GK::tr('api.FORBIDDEN');

        } else {
            $this->message = $message;
        }
    }
}
