<?php

namespace app\Logic;

abstract class Base
{
    // 错误信息
    protected $errorMessage = null;

    /**
     * 返回模型的错误信息
     * @access public
     * @return string|array
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}
