<?php

namespace app\Struct;

use Zxin\DataStruct\BaseProperty;

/**
 * 请求令牌数据结构
 * Class CsrfStructure
 */
class CsrfStruct extends BaseProperty
{
    /** @var string 令牌 */
    public $token;
    /** @var string 模式 */
    public $mode;

    public function __toString()
    {
        return $this->token;
    }

    public function isUpdate()
    {
        return 'update' === $this->mode;
    }
}
