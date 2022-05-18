<?php

namespace Geekor\Core\Exceptions;

use Exception;

class InputException extends Exception
{
    public $code = 4000;

    protected $status = 400;
    protected $message = 'input params error';

    public function __construct($code, $message = null, $status = 400)
    {
        $this->status = $status;
        $this->code = $code;

        if (empty($message)) {
            // 写在这里主要是为了翻译（没法写在上面）
            $this->message = trans('string.bm_input_error');

        } else {
            $this->message = $message;
        }
    }
}
