<?php
/**
 * Created by PhpStorm.
 * User: NHZEXG
 * Date: 2019/1/8
 * Time: 17:58
 */

namespace app\Middleware;

use app\Exception\JsonException;
use app\Logic\AdminRole;
use app\Model\AdminUser as AdminUserModel;
use app\Model\Permission as PermissionModel;
use app\Service\Auth;
use app\Traits\ShowReturn;
use Closure;
use ReflectionException;
use think\Request;
use think\Response;
use think\response\View;

class Authorize extends Middleware
{
    use ShowReturn;

    /**
     * @param Request $request
     * @param Closure $next
     * @return response
     * @throws JsonException
     * @throws ReflectionException
     */
    public function handle(Request $request, Closure $next)
    {
        $nodeName = $this->getNodeName($request);

        if (null === $nodeName) {
            return $next($request);
        }

        /** @var Auth\Permission $permission */
        $permission = $this->app->make(Auth\Permission::class);
        $nodeControl = $permission->queryNode($nodeName);

        if (null === $nodeControl) {
            return $next($request);
        }

        /** @var Auth $auth */
        $auth = $this->app->make(Auth::class);

        // 分析控制器是否继承AdminBase 使用 is_subclass_of 替代
        // 会话权限判断
        if (true !== $auth->check()) {
            $this->app->cookie->delete('login_time');
            return $this->jump($request, '需重新登录:');
        }

        /** @var AdminUserModel $user */
        $user = $auth->user();
        // 超级管理员跳过权限限制
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // 跳过权限验证
        return $next($request);

        //角色权限验证
        if (($flag & PermissionModel::FLAG_PERMISSION) > 0) {
            if (false === AdminRole::isPermissionAllowed($webConv->getRoleId(), $node->hash)) {
                return Response::create('权限不足', '', 403);
            }
        }

        return $next($request);
    }

    /**
     * 权限检查失败跳转
     * @param Request $request
     * @param         $message
     * @return response
     */
    protected function jump(Request $request, $message)
    {
        if (!$request->isAjax()) {
            // 构建跳转数据
            $jump = rawurlencode($request->url(true));
            return $this->error(
                $message,
                '/admin.login?' . http_build_query(['jump' => $jump])
            );
        } else {
            return Response::create($message, '', 401)
                ->header([
                    'Soft-Location' => $this->app->route->buildUrl('@admin.login')
                ]);
        }
    }

    /**
     * 操作错误跳转的快捷方法
     * @access protected
     * @param  mixed   $msg    提示信息
     * @param  string  $url    跳转的URL地址
     * @param  mixed   $data   返回的数据
     * @param  int     $wait   跳转等待时间
     * @param  array   $header 发送的Header信息
     * @return response
     */
    protected function error($msg = '', $url = null, $data = '', $wait = 3, array $header = [])
    {
        $type = ($this->app->request->isJson() || $this->app->request->isAjax()) ? 'json' : 'html';
        if (is_null($url)) {
            $url = $this->app->request->isAjax() ? '' : 'javascript:history.back(-1);';
        } elseif ('' !== $url) {
            $url = (strpos($url, '://') || 0 === strpos($url, '/')) ? $url : $this->app['url']->build($url);
        }

        $result = [
            'code' => 0,
            'msg'  => $msg,
            'data' => $data,
            'url'  => $url,
            'wait' => $wait,
        ];

        if ('html' == strtolower($type)) {
            /** @var View $respView */
            $respView = Response::create('/dispatch_jump', 'view');
            $response = $respView->assign($result);
        } else {
            $response = Response::create($result, $type)
                ->header($header)
                ->options(['jump_template' => $this->app->config->get('app.dispatch_error_tmpl')]);
        }

        return $response;
    }
}
