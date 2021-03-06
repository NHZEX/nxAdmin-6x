<?php

namespace app\controller\api\admin;

use app\Model\AdminRole;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\db\Query;
use think\Response;
use Zxin\Think\Auth\Annotation\Auth;
use function func\reply\reply_create;
use function func\reply\reply_not_found;
use function func\reply\reply_succeed;
use function func\reply\reply_table;

/**
 * Class Role
 * @package app\controller\api\admin
 */
class Role extends Base
{
    /**
     * @Auth("admin.role.info")
     * @param int $limit
     * @return Response
     * @throws DbException
     */
    public function index(int $limit = 1)
    {
        $where = $this->buildWhere($this->request->param(), [
            ['genre', '='],
        ]);

        $result = (new AdminRole())
            ->where($where)
            ->append(['genre_desc', 'status_desc'])
            ->paginate($limit);

        return reply_table($result);
    }

    /**
     * @Auth("admin.role.info")
     * @Auth("admin.user")
     * @param int $genre
     * @return Response
     */
    public function select($genre = 0)
    {
        if (empty($genre)) {
            $where = null;
        } else {
            $where = function (Query $query) use ($genre) {
                $query->where('genre', '=', $genre);
            };
        }
        $result = AdminRole::buildOption(null, $where);
        return reply_succeed($result);
    }

    /**
     * @Auth("admin.role.info")
     * @param int $id
     * @return Response
     * @throws DbException
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     */
    public function read(int $id)
    {
        $result = AdminRole::find($id);
        if (empty($result)) {
            return reply_not_found();
        }
        return reply_succeed($result);
    }

    /**
     * @Auth("admin.role.add")
     * @return Response
     */
    public function save()
    {
        AdminRole::create($this->getFilterInput());
        return reply_create();
    }

    /**
     * @Auth("admin.role.edit")
     * @param $id
     * @return Response
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function update($id)
    {
        $data = AdminRole::find($id);
        if (empty($data)) {
            return reply_not_found();
        }
        $data->save($this->getFilterInput());
        return reply_succeed();
    }

    /**
     * @Auth("admin.role.del")
     * @param $id
     * @return Response
     */
    public function delete($id)
    {
        AdminRole::destroy($id);
        return reply_succeed();
    }
}
