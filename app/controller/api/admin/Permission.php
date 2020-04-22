<?php

namespace app\controller\api\admin;

use app\Service\Auth\Annotation\Auth;
use app\Service\Auth\AuthScan;
use app\Service\Auth\Permission as AuthPermission;
use think\Response;
use function array_merge;
use function func\reply\reply_bad;
use function func\reply\reply_not_found;
use function func\reply\reply_succeed;

class Permission extends Base
{
    /**
     * @Auth("admin.permission.info")
     * @param AuthPermission $permission
     * @return Response
     */
    public function index(AuthPermission $permission)
    {
        $data = $permission->getTree('__ROOT__', 1);

        return reply_succeed($data);
    }

    /**
     * @Auth("admin.permission.info")
     * @param                $id
     * @param AuthPermission $permission
     * @return Response
     */
    public function read($id, AuthPermission $permission)
    {
        if (($info = $permission->queryPermission($id)) === null) {
            return reply_bad();
        }

        $allow = [];
        foreach ($info['allow'] ?? [] as $index => $item) {
            $feature = $permission->queryFeature($item);
            if ($feature) {
                $allow[] =  [
                    'name' => $item,
                    'desc' => $feature['desc'],
                ];
            }
        }
        $info['allow'] = $allow;

        return reply_succeed($info);
    }

    /**
     * @Auth("admin.permission.edit")
     * @param          $id
     * @param AuthScan $authScan
     * @return Response
     */
    public function update($id, AuthScan $authScan)
    {
        $input = $this->request->only(['sort', 'desc']);

        if (empty($input)) {
            return reply_bad();
        }
        if ($input['sort']) {
            $input['sort'] = (int) $input['sort'];
        }

        $perm = AuthPermission::getInstance();

        if (!$perm->queryPermission($id)) {
            return reply_not_found();
        }

        $permissions = $perm->getPermission();
        $permissions[$id] = array_merge($permissions[$id], $input);
        $perm->setPermission($permissions);

        $authScan->export($perm->getStorage()->toArray());

        return reply_succeed();
    }

    /**
     * 扫描权限
     * @Auth("admin.permission.scan")
     * @param AuthScan $authScan
     * @return Response
     */
    public function scan(AuthScan $authScan)
    {
        $authScan->refresh();
        return reply_succeed();
    }
}
