<?php
/**
 * Created by PhpStorm.
 * User: NHZEXG
 * Date: 2019/2/23
 * Time: 10:37
 */

namespace app\controller\admin;

use app\Logic\SystemMenu as SystemMenuLogic;
use app\Model\SystemMenu;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\facade\App;
use think\facade\View;
use think\Response;
use Tp\Model\Exception\ModelException;

class Menu extends Base
{
    public function index()
    {
        View::assign([
            'url_table' => url('table'),
            'url_page_edit' => url('edit'),
            'url_delete' => url('delete'),
            'url_export' => url('export'),
        ]);

        return View::fetch();
    }

    public function table()
    {
        $result = (new SystemMenu())->select();

        if (!$result->isEmpty()) {
            $result->append(['status_desc']);
        }
        return self::showTable([
            'data' => $result,
            'count' => $result->count(),
        ]);
    }

    /**
     * @param int|null $pkid
     * @return mixed
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @throws DbException
     */
    public function edit(?int $pkid = null)
    {
        if ($pkid) {
            /** @var SystemMenu $data */
            $data = (new SystemMenu())->wherePk($pkid)->find();
            $params['csrf_update'] = $this->generateCsrfToken($data->id, $data->lock_version);
        } else {
            $params['csrf'] = $this->generateCsrfTokenSimple();
        }

        View::assign([
            'edit_data' => $data ?? false,
            'url_save' => url('save', $params ?? []),
            'menu_data' => SystemMenu::getTextTree(),
            'node_data' => \app\Logic\Permission::queryNodeFlagsIsMenu(),
        ]);
        return View::fetch();
    }

    /**
     * @return Response
     * @throws ModelException
     */
    public function save()
    {
        $input = $this->request->param();
        $csrf = $this->getRequestCsrfToken();
        if ($csrf->isUpdate()) {
            [$pkid, $lock_version] = $this->parseCsrfToken($csrf);
            $data = SystemMenu::getOptimisticVer($pkid, $lock_version);
            if (false === $data instanceof SystemMenu) {
                return self::showMsg(CODE_COM_DATA_NOT_EXIST, '数据不存在');
            }
        } else {
            $data = new SystemMenu();
        }
        $result = $data->save($input);
        return self::showMsg(CODE_SUCCEED, $result);
    }

    /**
     * @return Response
     */
    public function export()
    {
        if (!App::isDebug()) {
            return self::showMsg(CODE_COM_UNABLE_PROCESS, '调试模式未开启不能使用该操作');
        }
        SystemMenuLogic::export();
        return self::showMsg(CODE_SUCCEED);
    }

    public function delete($pkid = null)
    {
        SystemMenu::destroy($pkid);
        return self::showMsg(CODE_SUCCEED);
    }
}