<?php
declare(strict_types=1);

namespace app\Service\Auth;

use HZEX\Blade\Register;
use think\Service;

/**
 * @deprecated
 * Class AuthService
 * @package app\Service\Auth
 */
class AuthService extends Service
{
    /**
     */
    public function register()
    {
        // 注册鉴权类
        $this->registeBladeExtension();
    }

    public function boot()
    {
    }

    protected function registeBladeExtension()
    {
        /** @var Register $register */
        $register = $this->app->make(Register::class);
        $register->directive('allows', function ($parameter) {
            return "<?php echo app('auth')->gate()->allows({$parameter}) ? 'true' : 'false' ?>";
        });
        $register->directive('denies', function ($parameter) {
            return "<?php echo app('auth')->gate()->denies({$parameter}) ? 'true' : 'false' ?>";
        });
        $register->directive('check', function ($parameter) {
            return "<?php echo app('auth')->gate()->check({$parameter}) ? 'true' : 'false' ?>";
        });
        $register->directive('any', function ($parameter) {
            return "<?php echo app('auth')->gate()->any({$parameter}) ? 'true' : 'false' ?>";
        });
    }
}
