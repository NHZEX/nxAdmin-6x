<?php

namespace app\controller\api\admin;

use app\Model\AdminUser;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\Response;
use Zxin\Think\Auth\Annotation\Auth;
use function func\reply\reply_create;
use function func\reply\reply_not_found;
use function func\reply\reply_succeed;
use function func\reply\reply_table;
use function trim;

/**
 * Class User
 * @package app\controller\api\admin
 */
class User extends Base
{
    /**
     * @Auth("admin.user.info")
     * @param int $limit
     * @return Response
     * @throws DbException
     */
    public function index(int $limit = 1)
    {
        $where = $this->buildWhere($this->request->param(), [
            ['genre', '='],
            ['role_id', '='],
        ]);
        $result = (new AdminUser())
            ->where($where)
            ->with(['beRoleName'])
            ->append(['status_desc', 'genre_desc', 'avatar_data'])
            ->paginate($limit);

        return reply_table($result);
    }

    /**
     * @Auth("admin.user.info")
     * @param int $id
     * @return Response
     * @throws DbException
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     */
    public function read(int $id)
    {
        $result = AdminUser::find($id);
        if (empty($result)) {
            return reply_not_found();
        }
        return reply_succeed($result);
    }

    /**
     * @Auth("admin.user.add")
     * @return Response
     */
    public function save()
    {
        AdminUser::create($this->getFilterInput());

        return reply_create();
    }

    /**
     * @Auth("admin.user.edit")
     * @param int $id
     * @return Response
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function update(int $id)
    {
        /** @var AdminUser $result */
        $result = AdminUser::find($id);
        if (empty($result)) {
            return reply_not_found();
        }

        $data = $this->getFilterInput();
        if (isset($data['password']) && empty(trim($data['password']))) {
            unset($data['password']);
        }
        $result->save($data);

        return reply_succeed();
    }

    /**
     * @Auth("admin.user.del")
     * @param int $id
     * @return Response
     */
    public function delete(int $id)
    {
        AdminUser::destroy($id);

        return reply_succeed();
    }
}
