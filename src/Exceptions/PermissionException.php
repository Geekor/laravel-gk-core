<?php

namespace Geekor\Core\Exceptions;

use Exception;

class PermissionException extends Exception
{
    protected $status = 401;
    protected $message = 'no access permission';

    public function __construct($message = null, $status = 401)
    {
        $this->status = $status;
        
        if (empty($message)) {
            // 写在这里主要是为了翻译（没法写在上面）
            $this->message = trans('string.bm_no_access_permission');

        } else {
            $this->message = $message;
        }
    }
}
