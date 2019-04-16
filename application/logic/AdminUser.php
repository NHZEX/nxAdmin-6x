<?php
/**
 * Created by PhpStorm.
 * User: NHZEXG
 * Date: 2018/10/20
 * Time: 11:18
 */

namespace app\logic;

use app\common\traits\PrintAbnormal;
use app\exception\BusinessResult;
use app\facade\WebConv;
use app\model\AdminUser as AdminUserModel;
use basis\IP;
use RuntimeException;
use think\Exception;
use think\exception\DbException;

class AdminUser extends Base
{
    use PrintAbnormal;

    const LOGIN_TYPE_NAME = 'username';
    const LOGIN_TYPE_EMAIL = 'email';

    /**
     * 用户登陆 邮箱或用户名
     * @param string $username
     * @param string $password
     * @param bool $rememberme
     * @return bool
     * @throws Exception
     */
    public function loginNameWaitEmail(string $username, string $password, bool $rememberme = false)
    {
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return $this->login(self::LOGIN_TYPE_EMAIL, $username, $password, $rememberme);
        } else {
            return $this->login(self::LOGIN_TYPE_NAME, $username, $password, $rememberme);
        }
    }

    /**
     * 用户登陆 自定义
     * @param string $type
     * @param string $username
     * @param string $password
     * @param bool $rememberme
     * @return bool
     * @throws Exception
     */
    public function login(string $type, string $username, string $password, bool $rememberme = false)
    {
        /** @var AdminUserModel|null $user */
        try {
            switch ($type) {
                case self::LOGIN_TYPE_NAME:
                    $user = (new AdminUserModel)->where('username', $username)->find();
                    break;
                case self::LOGIN_TYPE_EMAIL:
                    $user = (new AdminUserModel)->where('email', $username)->find();
                    break;
                default:
                    throw new RuntimeException("无法处理的类型：{$type}");
            }
            if (false === $user instanceof AdminUserModel) {
                throw new BusinessResult('账号或密码错误');
            }
            if (false === $user->verifyPassword($password)) {
                throw new BusinessResult('账号或密码错误');
            }
            if (AdminUserModel::STATUS_NORMAL !== $user->status) {
                throw new BusinessResult("账号状态：{$user->status_desc}");
            }

            $user->last_login_time = time();
            $user->last_login_ip = IP::getIp(true);
            if ($user->save()) {
                // 创建会话
                WebConv::createSession($user, $rememberme);
            } else {
                throw new BusinessResult('登录信息更新失败，请重试');
            }
        } catch (BusinessResult $businessResult) {
            $this->errorMessage = $businessResult->getMessage();
            return false;
        } catch (DbException $e) {
            throw new RuntimeException('数据库访问异常', 0, $e);
        }
        return true;
    }

    /**
     * @return bool
     */
    public function testRemember()
    {
        $user = WebConv::decodeRememberToken();
        if (false === $user instanceof AdminUserModel) {
            return false;
        }
        $user->last_login_time = time();
        $user->save();
        WebConv::createSession($user, true);
        return true;
    }
}
